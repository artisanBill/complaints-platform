<?php

class Files
{
    public static $providers;
    public static $path;
    public static $maxSizePossible;
    public static $maxSizeAllowed;
    protected static $cachePath;
    protected static $ext;
    protected static $type = '';
    protected static $filename = NULL;
    protected static $mimetype;
    protected static $uesrPath = NULL;

    /**
     * Constructor
     */
    public function __construct()
    {
        if ( get_instance()->currentUser )
        {
            static::$uesrPath .= substr(sha1('boone-' . get_instance()->currentUser->id), 0, 8) . '/';
        }
        static::$path = BOONE . 'public/uploads/users/';
        static::$cachePath = BOONE . 'public/uploads/users/cache/files/';

       /* if ($providers = Settings::get('filesEnabledProviders'))
        {
            static::$providers = explode(',', $providers);

            // make 'local' mandatory. We search for the value because of backwards compatibility
            if ( ! in_array('local', static::$providers))
            {
                array_unshift(static::$providers, 'local');
            }
        }
        else
        {
            static::$providers = ['local'];
        }*/

        static::$providers = ['local'];

        // work out the most restrictive ini setting
        $postMax = str_replace('M', '', ini_get('post_max_size'));
        $filemax = str_replace('M', '', ini_get('upload_max_filesize'));
        // set the largest size the server can handle and the largest the admin set
        static::$maxSizePossible = ($filemax > $postMax ? $postMax : $filemax) * 1048576; // convert to bytes
        static::$maxSizeAllowed = Setting::get('filesUploadLimit'); // convert this to bytes also

        set_exception_handler([$this, 'exceptionHandler']);
        get_instance()->load->model('file/file_model');
        get_instance()->load->model('file/folders_model');
        get_instance()->load->helper('text');
    }

    /**
     * Get all folders and files within a folder
     *
     * @param   int     $parent The id of this folder
     * @return  array
     */
    public static function folderContents($parent = 0)
    {
        // they can also pass a url hash such as #foo/bar/some-other-folder-slug
        if ( ! is_numeric($parent))
        {
            $segment = explode('/', trim($parent, '/#'));
            $result = get_instance()->folders_model->getBy('slug', array_pop($segment));

            $parent = ($result ? $result->id : 0);
        }

        $folders = get_instance()->folders_model->where('parentId', $parent)
            ->where('hidden', 0)
            ->order_by('sort')
            ->getAll();

        $files = get_instance()->file_model->where('folderId', $parent)
            ->order_by('sort')
            ->getAll();

        // let's be nice and add a date in that's formatted like the rest of the CMS
        if ($folders)
        {
            foreach ($folders as &$folder) 
            {
                $folder->formattedDate = format_date($folder->dateAdded);

                $folder->file_count = get_instance()->file_model->count_by('folderId', $folder->id);
            }
        }

        if ($files)
        {
            get_instance()->load->library('keywords/keywords');

            foreach ($files as &$file)
            {
                $file->keywords_hash = $file->keywords;
                $file->keywords = get_instance()->keywords->getString($file->keywords);
                $file->formattedDate = format_date($file->dateAdded);
            }
        }

        return static::result(TRUE, NULL, NULL, ['folder' => $folders, 'file' => $files, 'parentId' => $parent]);
    }

    /**
     * Get all folders in a tree
     *
     * @return array
     */
    public static function folderTree()
    {
        $folders = [];
        $folder_array = [];

        get_instance()->db->select('id, parentId, slug, name')->where('hidden', 0)->order_by('sort');
        $all_folders = get_instance()->folders_model->getAll();

        // we must reindex the array first
        foreach ($all_folders as $row)
        {
            $folders[$row->id] = (array) $row;
        }

        unset($tree);

        // build a multidimensional array of parent > children
        foreach ($folders as $row)
        {
            if (array_key_exists($row['parentId'], $folders))
            {
                // add this folder to the children array of the parent folder
                $folders[$row['parentId']]['children'][] =& $folders[$row['id']];
            }

            // this is a root folder
            if ($row['parentId'] == 0)
            {
                $folder_array[] =& $folders[$row['id']];
            }
        }
        return $folder_array;
    }

    /**
     * Create an empty folder
     *
     * @param   array  $post
     * @return  array
     */
    public static function createFolder(array $post)
    {
        $i = '';
        $originalSlug = static::createSlug($post['slug']);
        $originalName = $post['name'];

        $slug = $originalSlug;

        while (get_instance()->folders_model->countBy('slug', $slug))
        {
            $i++;
            $slug = $originalSlug . '-' . $i;
            $name = $originalName . '-' . $i;
        }

        $insert = [
            'slug'          => $slug, 
            'name'          => $post['name'],
            'description'   => $post['description'],
            'format'        => $post['fileType'],
            'location'      => 'local',
            'createOn'      => time(),
            'sort'          => time(),
        ];

        return get_instance()->folders_model->insert($insert);
    }

    /**
     * Get a list of file formats.
     *
     * @param  string $format
     * @return array
     */
    public static function formatArray(string $format)
    {
        $arr = [];
        if ( strpos($format, ',') )
        {
            $arr = explode(',', $format);
        }
        else
        {
            $arr[] = $format;
        }
        return $arr;
    }

    /**
     * Generate a list of file formats.
     *
     * @param  string $format
     * @return string
     */
    public static function extJs(string $format)
    {
        $array = static::formatArray($format);
        return '.' . implode(',.', $array);
    }

    /**
     * Check if an unindexed container exists in the cloud
     *
     * @param   string  $name       The container name
     * @param   string  $location   Amazon/Rackspace
     * @return  array
    */
    public static function checkContainer($name, $location)
    {
        get_instance()->storage->load_driver($location);

        $containers = get_instance()->storage->list_containers();

        foreach($containers AS $container)
        {
            if ($name === $container)
            {
                return static::result(true, lang('files:container_exists'), $name);
            }
        }
        return static::result(false, lang('files:container_not_exists'), $name);
    }

    /**
     * Rename a folder
     *
     * @param   int     $id     The id of the folder
     * @param   string  $name   The new name
     * @return  array
     */
    public static function renameFolder($id = 0, $name)
    {
        $i = '';
        $originalSlug = static::create_slug($name);
        $originalName = $name;

        $slug = $originalSlug;

        while (get_instance()->folders_model->where('id !=', $id)->count_by('slug', $slug))
        {
            $i++;
            $slug = $originalSlug . '-' . $i;
            $name = $originalName . '-' . $i;
        }

        $insert = array('slug' => $slug, 
                        'name' => $name
                        );

        get_instance()->folders_model->update($id, $insert);

        return static::result(true, lang('files:item_updated'), $insert['name'], $insert);
    }

    /**
     * Get A Single File
     *
     * @param   int     $identifier The id or filename
     * @return  array
     */
    public static function getFile($identifier = 0)
    {
        // they could have specified the row id or the actual filename
        $column = (strlen($identifier) === 15 or strpos($identifier, '.') === false) ? 
                    'files.id' : 
                    'filename';

        $results = get_instance()->file_model->select('files.*, file_folders.name folder_name, file_folders.slug folder_slug')
            ->join('file_folders', 'file_folders.id = files.folderId')
            ->get_by($column, $identifier);

        $message = $results ? null : lang('files:no_records_found');

        return static::result( (bool) $results, $message, null, $results);
    }

    /**
     * Get Known Files
     *
     * @param   string  $location   The cloud provider or local
     * @return  array
     */
    public static function getFiles(array $lists, string $location = 'local')
    {
        $results = get_instance()->file_model->select('files.*, fileFolders.name folderName, fileFolders.slug folderSlug')
            ->join('fileFolders', 'fileFolders.id = files.folderId')
            ->where('location', $location);
            

       /* $message = $results ? null : lang('files:no_records_found');

        return static::result( (bool) $results, $message, null, $results);*/
    }

    /**
     * Delete an empty folder
     *
     * @param   int     $id     The id of the folder
     * @return  array
     */
    public static function deleteFolder($id = 0)
    {
        $folder = get_instance()->folders_model->get($id);

        if ( ! $files = get_instance()->file_model->getBy('folderId', $id) and ! get_instance()->folders_model->getBy('parentId', $id))
        {
            get_instance()->folders_model->delete($id);

            return static::result(true, lang('file.item-deleted'), $folder->name);
        }
        else
        {
            return static::result(false, lang('file.folder-not-empty'), $folder->name);
        }
    }

    /**
     * Upload a file
     *
     * @param   int    $folderId The folder to upload it to
     * @param   bool   $name The filename
     * @param   string $field Like CI this defaults to "userfile"
     * @param   bool   $width The width to resize the image to
     * @param   bool   $height The height to resize the image to
     * @param   bool   $ratio Keep the aspect ratio or not?
     * @param   string $alt "alt" attribute, here so that it may be set when photos are initially uploaded
     * @param   array  $allowed types       
     * @return  array|bool
     */
    public static function upload($folderId, $name = false, $field = 'upload', $width = false, $height = false, $ratio = false, $allowed_types = false, $alt = NULL, $replaceFile = false)
    {
        $folder = get_instance()->folders_model->get($folderId);
        if ($folder)
        {
            if ( ! $checkDir = static::checkDir(static::$path . $folder->slug . '/'))
            {
                return $checkDir;
            }

            if ( ! $checkCacheDir = static::checkDir(static::$cachePath))
            {
                return $checkCacheDir;
            }

            if ( ! $checkExt = static::checkExt($field))
            {
                return $checkExt;
            }

            // this keeps a long running upload from stalling the site
            session_write_close();

       
            get_instance()->load->library('upload');

            $uploadConfig = [
                'upload_path'           => static::$path . $folder->slug . '/' . static::$uesrPath,
                'fileName'              => $replaceFile ? $replaceFile->filename : static::$filename,
                'overwrite'             => TRUE,
                'file_ext_tolower'      => TRUE,
                // if we want to replace a file, the file name should already be encrypted, the option was true then
                'encrypt_name'          => TRUE
            ];

            if ( ! is_dir($uploadConfig['upload_path']) )
            {
                @mkdir($uploadConfig['upload_path'], 0777);
            }

            // If we don't have allowed types set, we'll set it to the
            // current file's type.
            $uploadConfig['allowed_types'] = str_replace(',', '|', $folder->format);

            get_instance()->upload->initialize($uploadConfig);

            if (get_instance()->upload->do_upload($field))
            {
                $file = get_instance()->upload->data();

                $data = [
                    'folderId'      => (int) $folderId,
                    'userId'        => (int) get_instance()->currentUser->id,
                    'type'          => static::$type,
                    'name'          => $replaceFile ? $replaceFile->name : $name ? $name : $file['orig_name'],
                    //'path'          => //Brocade::source('addons/data/storage/' . $folder->slug . '/' . $file['file_name']),
                    'path'          => '/uploads/users/' . $folder->slug . '/' . static::$uesrPath . $file['file_name'],
                    'description'   => $replaceFile ? $replaceFile->description : '',
                    //'alt_attribute' => trim($replaceFile ? $replaceFile->alt_attribute : $alt),
                    'filename'      => $file['file_name'],
                    'extension'     => $file['file_ext'],
                    'mimetype'      => $file['file_type'],
                    'filesize'      => $file['file_size'],
                    'width'         => (int) $file['image_width'],
                    'height'        => (int) $file['image_height'],
                    'createOn'     => now()
                ];
                // perhaps they want to resize it a bit as they upload
                //get_instance()->load->library('img');
                if ( $file['is_image'] )
                {
                    get_instance()->load->library('image_lib');

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = static::$path . $data['filename'];
                    $config['new_image']        = static::$path . $data['filename'];
                    $config['maintain_ratio']   = (bool) $ratio;
                    $config['width']            = $data['width'] ? : 0;
                    $config['height']           = $data['height'] ? : 0;
                    get_instance()->image_lib->initialize($config);
                    get_instance()->image_lib->resize();

                    $data['width'] = get_instance()->image_lib->width;
                    $data['height'] = get_instance()->image_lib->height;

                    require APPPATH . 'libraries/Img.php';
                    //Img::init();   
                    Img::open($uploadConfig['upload_path'] . $data['filename']);   
                    Img::water(APPPATH . 'libraries/img/boone.png' , 10);
                    Img::save($uploadConfig['upload_path'] . $data['filename']);
                }

                if($replaceFile)
                {
                    $fileId = $replaceFile->id;
                    get_instance()->file_model->update($replaceFile->id, $data);
                }
                else
                {
                    $data['id'] = substr(md5(microtime() . $data['filename']), 0, 15);
                    $i = 0;
                    while(get_instance()->file_model->exists($data['id']))
                    {
                        $data['id'] = substr(md5(microtime() . $data['filename'] . $i++), 0, 15);
                    }
                    $fileId = $data['id'];
                    get_instance()->file_model->insert($data);
                }

                if ($data['type'] !== 'i')
                {
                    // so it wasn't an image. Now that we know the id we need to set the path as a download
                    get_instance()->file_model->update($fileId, [
                        'path' => '/uploads/users/' . $folder->slug . '/' . static::$uesrPath . $file['file_name']
                    ]);
                }

                if ($folder->location !== 'local')
                {
                    header("Connection: close");

                    return Files::move($fileId, $data['filename'], 'local', $folder->location);
                }

                header("Connection: close");

                return $data;
                //return static::result(true, lang('files:file_uploaded'), $data['name'], ['id' => $fileId] + $data);
            }
            else
            {
                $errors = get_instance()->upload->display_errors();
                header("Connection: close");
                return static::result(false, $errors);
            }
        }
        else
        {
            header("Connection: close");
            return static::result(false, lang('files:specify_valid_folder'));
        }
    }
    /**
     * Get file type all.
     *
     * @return  array
     */
    public static function typeImg(string $type)
    {

        $imgArr = [
            'a' => 'audio.png',
            'v' => 'video.png',
            'd' => 'document.png',
            'i' => 'image.png',
            'o' => 'data.png',
        ];

        return 'resources/images/filetype/' . $imgArr[$type];
    }

    /**
     * allowed file format.
     *
     * @return array
     */
    public static function allowedFile()
    {
        return [
            'a' => ['mpga', 'mp2', 'mp3', 'ra', 'rv', 'wav'],
            'v' => ['mpeg', 'mpg', 'mpe', 'mp4', 'flv', 'qt', 'mov', 'avi', 'movie', 'ogv', 'webm'],
            'd' => ['pdf', 'xls', 'ppt', 'pptx', 'txt', 'text', 'log', 'rtx', 'rtf', 'xml', 'xsl', 'doc', 'docx', 'xlsx', 'word', 'xl', 'csv', 'pages', 'numbers'],
            'i' => ['bmp', 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'tiff', 'tif'],
            'o' => ['psd', 'gtar', 'tar', 'tgz', 'xhtml', 'zip', 'css', 'html', 'htm', 'shtml', 'svg'],
        ];
    }

    /**
     * Check the extension and clean the file name
     * 
     *
     * @return  bool
     *
     */
    private static function checkExt($field)
    {
        if ( ! empty($_FILES[$field]['name']))
        {
            $ext        = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            $allowed    = static::allowedFile();

            foreach ($allowed as $type => $ext_arr)
            {               
                if (in_array(strtolower($ext), $ext_arr))
                {
                    static::$type        = $type;
                    static::$ext         = implode('|', $ext_arr);
                    static::$filename    = trim(url_title($_FILES[$field]['name'], 'dash', true), '-');

                    break;
                }
            }

            if ( ! static::$ext)
            {
                return static::result(false, lang('files:invalid_extension'), $_FILES[$field]['name']);
            }
        }       
        elseif (get_instance()->method === 'upload')
        {
            return static::result(false, lang('files.upload-error'));
        }

        return static::result(true);
    }

    /**
     * List Files -- get_files() returns database records. This pulls from
     * the cloud instead but for completeness it will fetch local file names 
     * from the database if the location is "local"
     *
     * @param   string  $location   The cloud provider or local
     * @param   string  $container  The container or folder to list files from
     * @return  array
     */
    public static function listFiles($location = 'local', $container = '')
    {
        $i = 0;
        $files = [];

        // yup they want real live file names from the cloud
        if ($location !== 'local' and $container)
        {
            get_instance()->storage->load_driver($location);

            $cloud_list = get_instance()->storage->list_files($container);

            if ($cloud_list)
            {
                foreach ($cloud_list as $value) 
                {
                    static::_get_file_info($value['name']);

                    if ($location === 'amazon-s3')
                    {
                        // we'll create a path to store like rackspace does
                        $url = get_instance()->parser->parse_string(Settings::get('files_s3_url'), array('bucket'=> $container), true);
                        $path = rtrim($url, '/').'/'.$value['name'];
                    }
                    elseif ($location === 'rackspace-cf')
                    {
                        // fetch the cdn uri from Rackspace
                        $cf_container = get_instance()->storage->get_container($container);
                        $path = $cf_container['cdn_uri'];

                        // they are trying to index a non-cdn enabled container
                        if ( ! $cf_container['cdn_enabled'])
                        {
                            // we'll try to enable it for them
                            if ( ! $path = get_instance()->storage->create_container($container, 'public'))
                            {
                                // epic fails all around!!
                                return static::result(false, lang('files:enable_cdn'), $container);
                            }
                        }
                        $path = rtrim($path, '/').'/'.$value['name'];
                    }

                    $files[$i]['filesize']      = ((int) $value['size']) / 1000;
                    $files[$i]['filename']      = $value['name'];
                    $files[$i]['extension']     = static::$ext;
                    $files[$i]['type']          = static::$type;
                    $files[$i]['mimetype']      = static::$mimetype;
                    $files[$i]['path']          = $path;
                    $files[$i]['dateAdded']    = $value['time'];
                    $i++;
                }
            }
        }
        // they're wanting a local list... give it to 'em but only if the file really exists
        elseif ($location === 'local') 
        {
            $results = get_instance()->file_model->select('filename, filesize')
                ->join('file_folders', 'file_folders.id = files.folderId')
                ->where('slug', $container)
                ->getAll();

            if ($results)
            {
                foreach ($results as $value) 
                {
                    if (file_exists(static::$path . $value->filename))
                    {
                        $files[$i]['filesize']      = $value->filesize;
                        $files[$i]['filename']      = $value->filename;
                        $files[$i]['extension']     = $value->extension;
                        $files[$i]['type']          = $value->type;
                        $files[$i]['mimetype']      = $value->mimetype;
                        $files[$i]['path']          = $value->path;
                        $files[$i]['dateAdded']    = $value->dateAdded;
                        $i++;
                    }
                }
            }
        }

        $message = $files ? null : lang('files:no_records_found');

        return static::result( (bool) $files, $message, null, $files);
    }

    /**
     * Index files from a remote container
     *
     * @param   string  $folderId  The folder id to refresh. Files will be fetched from its assigned container
     * @return  array
     */
    public static function synchronize($folderId)
    {
        $folder = get_instance()->folders_model->get_by('id', $folderId);

        $files = Files::listFiles($folder->location, $folder->remote_container);

        // did the fetch go ok?
        if ($files['status'])
        {
            $validRecords = [];
            $known = [];
            $known_files = get_instance()->file_model->where('folderId', $folderId)->getAll();

            // now we build an array with the database filenames as the keys so we can compare with the cloud list
            foreach ($known_files as $item)
            {
                $known[$item->filename] = $item;
            }

            foreach ($files['data'] as $file)
            {
                // it's a totally new file
                if ( ! array_key_exists($file['filename'], $known))
                {
                    $insert = [
                        'id'            => substr(md5(microtime() . $data['filename']), 0, 15),
                        'folderId'      => $folderId,
                        'userId'        => get_instance()->currentUser->id,
                        'type'          => $file['type'],
                        'name'          => $file['filename'],
                        'filename'      => $file['filename'],
                        'path'          => $file['path'],
                        'description'   => '',
                        'extension'     => $file['extension'],
                        'mimetype'      => $file['mimetype'],
                        'filesize'      => $file['filesize'],
                        'dateAdded'     => $file['dateAdded']
                    ];

                    // we add the id to the list of records that have existing files to match them
                    $validRecords[] = get_instance()->file_model->insert($insert);
                }
                // it's totally not a new file
                else
                {
                    // update with the details we got from the cloud
                    get_instance()->file_model->update($known[$file['filename']]->id, $file);

                    // we add the id to the list of records that have existing files to match them
                    $validRecords[] = $known[$file['filename']]->id;
                }
            }

            // Ok then. Let's clean up the records with no files and get out of here
            get_instance()->db->where('folderId', $folderId)
                ->where_not_in('id', $validRecords)
                ->delete('files');

            return static::result(true, lang('files:synchronization_complete'), $folder->name, $files['data']);
        }
        else
        {
            return static::result(null, lang('files:no_records_found'));
        }
    }


    /**
     * Rename a file
     *
     * @param   int     $id     The id of the file
     * @param   string  $name   The new name
     * @return  array
     *
    **/
    public static function renameFile($id = 0, $name)
    {
        // physical filenames cannot be changed because of the risk of breaking embedded urls so we just change the db
        get_instance()->file_model->update($id, array('name' => $name));

        return static::result(true, lang('files:item_updated'), $name, array('id' => $id, 'name' => $name));
    }

    /**
     * Delete a file
     *
     * @param   int     $id     The id of the file
     * @return  array
     */
    public static function replaceFile($to_replace, $folderId, $name = false, $field = 'userfile', $width = false, $height = false, $ratio = false, $allowed_types = false, $alt_attribute = NULL)
    {
        if ($file_to_replace = get_instance()->file_model->select('files.*, file_folders.name foldername, file_folders.slug, file_folders.location, file_folders.remote_container')
            ->join('file_folders', 'files.folderId = file_folders.id')
            ->get_by('files.id', $to_replace))
        {
            //remove the old file...
            static::unlinkFile($file_to_replace);

            //...then upload the new file
            $result = static::upload($folderId, $name, $field, $width, $height, $ratio, $allowed_types, $alt_attribute, $file_to_replace);

            // remove files from cache
            if( $result['status'] == 1 )
            {
                //md5 the name like they do it back in the thumb function
                $cached_fileName = md5($file_to_replace->filename) . $file_to_replace->extension;
                $path = Settings::get('cache_dir') . 'image_files/';
                
                $cached_files = glob( $path . '*_' . $cached_fileName );

                foreach($cached_files as $full_path)
                {
                    @unlink($full_path);
                }
            }

            return $result;
        }

        return static::result(false, lang('files:item_not_found'), $id);
    }

    /**
     * Check our upload directory
     * 
     * This is used on the local filesystem
     *
     * @return  bool
     */
    public static function checkDir($path)
    {
        if (is_dir($path) and is_really_writable($path))
        {
            return static::result(true);
        }
        elseif ( ! is_dir($path))
        {
            if ( ! mkdir($path, 0777, true))
            {
                return static::result(false, lang('file.mkdir-error'), $path);
            }
            else
            {
                // create a catch all html file for safety
                $uph = fopen($path . 'index.html', 'w');
                fclose($uph);
            }
        }
        else
        {
            if ( ! chmod($path, 0777))
            {
                return static::result(false, 'Create chmod perssions is not.');
            }
        }
        return TRUE;
    }

    /**
     * Permissions
     * 
     * Return a simple array of allowed actions
     *
     * @return  array
     */
    public static function alloweDactions()
    {
        $allowedActions = [];

        foreach (get_instance()->moduleModel->roles('file') as $value)
        {
            // build a simplified permission list for use in this module
            if (isset(get_instance()->permissions['file']) and array_key_exists($value, get_instance()->permissions['file']) or get_instance()->currentUser->groupName == 'developer')
            {
                $allowedActions[] = $value;
            }
        }

        return $allowedActions;
    }

    /**
     * Delete a file
     *
     * @param   array     $id     The id of the file
     * @return  bool
     */
    public static function deleteFile($araryFileId = [])
    {
        get_instance()->load->model('keywords/keywordModel');

        if ( $araryFileId )
        {
            foreach ($araryFileId as $val)
            {
                $file = get_instance()->file_model
                    ->select('files.*, fileFolders.name foldername, fileFolders.slug, fileFolders.location')
                    ->join('fileFolders', 'files.folderId = fileFolders.id')
                    ->getBy('files.id', $val);
                if ( $file )
                {
                    get_instance()->keywordModel->deleteApplied($file->keywords);

                    get_instance()->file_model->delete($val);

                    @unlink(static::$path .'/' .$file->slug . '/' . $file->filename);
                }
            }
        }
    }

    /**
     * Search all files and folders
     *
     * @param   int     $search     The keywords to search for
     * @return  array
     */
    public static function search($search, $limit = 5)
    {
        $results = [];
        $search = explode(' ', $search);

        // first we search folders
        get_instance()->folders_model->select('name, parentId');
        
        foreach ($search as $match)
        {
            $match = trim($match);

            get_instance()->folders_model->like('name', $match)
                ->or_like('location', $match);
        }

        $results['folder'] = get_instance()->folders_model->limit($limit)
            ->getAll();


        // search the file records
        get_instance()->file_model->select('name, folderId');

        foreach ($search as $match) 
        {
            $match = trim($match);

            get_instance()->file_model->like('name', $match)
            ->or_like('filename', $match)
            ->or_like('extension', $match);
        }

        $results['file'] =  get_instance()->file_model->limit($limit)
            ->getAll();

        // search for file by tagged keyword
        $results['tagged'] = get_instance()->file_model->select('files.*')
            ->limit($limit)
            ->get_tagged($search);

        if ($results['file'] or $results['folder'] or $results['tagged'])
        {
            return static::result(true, null, null, $results);
        }

        return static::result(false, lang('files:no_records_found'));
    }

    /**
     * Create Slug
     * 
     * Strip all odd characters out of a name and lowercase it
     *
     * @param   string  $name   The uncleaned name string
     * @return  string
     */
    protected static function createSlug($name)
    {
        $name = convert_accented_characters($name);

        return strtolower(preg_replace('/-+/', '-', preg_replace('/[^a-zA-Z0-9]/', '-', $name)));
    }

    /**
     * Result
     * 
     * Return a message in a uniform format for the entire library
     *
     * @param   bool    $status     Operation was a success or failure
     * @param   string  $message    The failure message to return
     * @param   mixed   $args       Arguments to pass to sprint_f
     * @param   mixed   $data       Any data to be returned
     * @return  array
     */
    public static function result($status = TRUE, $message = '', $args = FALSE, $data = '')
    {
        return [
            'status'   => $status, 
            'message'  => $args ? sprintf($message, $args) : $message, 
            'data'     => $data
        ];
    }

    /**
     * Physically delete a file
     * 
     * @return  bool
     */
    private static function unlinkFile($file)
    {
        if( ! isset($file->filename) )
        {
            return FALSE;
        }

        if ($file->location === 'local')
        {
            @unlink(static::$path . $file->filename);
        }
        else
        {
            get_instance()->storage->load_driver($file->location);
            get_instance()->storage->delete_file($file->remote_container, $file->filename);

            @unlink(static::$cachePath . $file->filename);
        }

        return TRUE;
    }

    /**
     * Exception Handler
     * 
     * Return a the error message thrown by Cloud Files
     *
     * @return  array
     */
    public static function exceptionHandler($e)
    {
        log_message('debug', $e->getMessage());

        echo json_encode( 
            array('status'  => false, 
                  'message' => $e->getMessage(),
                  'data'    => ''
                 )
        );
    }
}