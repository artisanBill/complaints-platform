<?php

class Folders_model extends Boone_Model
{
    private $folders = [];

    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'file_folders';

    /**
     * Exists
     *
     * Checks if a given folder exists.
     *
     * @param   int     The folder id or slug
     * @return  bool    If the folder exists
     */
    public function exists($folder = 0)
    {
        if (is_numeric($folder))
        {
            $count = ['id' => $folder];
        }
        else
        {
            $count = ['slug' => $folder];
        }

        return (bool) (parent::countBy($count) > 0);
    }

    /**
     * Has Children
     *
     * Checks if a given folder has children or not.
     *
     * @param   int     The folder id
     * @return  bool    If the folder has children
     */
    public function hasChildren($folderId = 0)
    {
        return (bool) (parent::countBy(['parentId' => $folderId]) > 0);
    }

    /**
     * Folder Tree
     *
     * Get folder in an array
     *
     * @uses folder_subtree
     */
    public function folderTree($parentId = 0, $depth = 0, &$arr = [])
    {
        $arr = $arr ? $arr : [];

        if ($parentId === 0)
        {
            $arr    = [];
            $depth  = 0;
        }

        $folders = $this
            ->order_by('filefolders.name')
            ->get_many_by(['parentId' => $parentId]);

        if ( ! $folders)
        {
            return $arr;
        }

        static $root = null;

        foreach ($folders as $folder)
        {
            if ($depth < 1)
            {
                $root = $folder->id;
            }

            $folder->rootid = $root;
            $folder->depth = $depth;
            $folder->countfiles = sizeof($this->db->get_where('files', ['folderId' => $folder->id])->result());
            $arr[$folder->id] = $folder;
            $oldsize = sizeof($arr);

            $this->folderTree($folder->id, $depth+1, $arr);

            $folder->countSubfolders   = sizeof($arr) - $oldsize;
        }

        if ($parentId === 0)
        {
            foreach ($arr as $id => &$folder)
            {
                $folder->virtualPath = $this->buildAscSegments($id, [
                    'segments'  => $arr,
                    'separator' => '/',
                    'attribute' => 'slug'
                ]);
            }

            $this->folders = $arr;
        }

        if ($parentId > 0 && $depth < 1)
        {
            foreach ($arr as $id => &$folder)
            {
                $folder->virtualPath = $this->folders[$id]->virtualPath;
            }
        }

        return $arr;
    }

    /**
     * Get Folders
     *
     * Get the full array of folders
     *
     * @return  array
     */
    public function getFolders($id = 0)
    {
        if ($id)
        {
            $this->folderTree($id);
        }
        elseif (empty($this->_folder))
        {
            $this->folderTree();
        }
        
        return $this->folders;
    }

    public function buildAscSegments($id, $options = [])
    {
        if ( ! isset($options['segments']))
        {
            return;
        }

        $defaults = [
            'attribute' => 'name',
            'separator' => ' &raquo; ',
            'limit'     => 0
        ];

        $options = array_merge($defaults, $options);

        extract($options);

        $arr = [];

        while (isset($segments[$id]))
        {
            array_unshift($arr, $segments[$id]->{$attribute});
            $id = $segments[$id]->parent_id;
        }

        if (is_int($limit) && $limit > 0 && sizeof($arr) > $limit)
        {
            array_splice($arr, 1, -($limit-1), '&#8230;');
        }

        return implode($separator, $arr);
    }

    public function getByPath($path)
    {
        if (is_array($path))
        {
            $path = implode('/', $path);
        }

        $path = trim($path, '/');

        if (empty($this->folders))
        {
            $this->getfolders();
        }

        foreach ($this->folders as $id => $folder)
        {
            if ($folder->virtualPath == $path)
            {
                return $folder;
            }
        }

        return [];
    }
}