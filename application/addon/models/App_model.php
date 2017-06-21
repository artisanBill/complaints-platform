<?php

class App_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'applications';

	/**
	 * Caches modules that exist
	 *
	 * @var array
	 */
	private $moduleExists = [];

	/**
	 * Caches modules that are enabled
	 *
	 * @var array
	 */
	private $moduleEnabled = [];
	
	/**
	 * Caches modules that are installed
	 *
	 * @var array
	 */
	private $moduleInstalled = [];

	/**
	 * Get
	 *
	 * Return an array containing module data
	 *
	 * @param	string	$slug		The name of the module to load
	 * @return	array
	 */
	public function get($slug = '')
	{
		// Have to return an associative array of null values for backwards compatibility.
		$nullArray = [
			'name'		=> NULL,
			'slug'		=> NULL,
			'version'	=> NULL,
			'description'=> NULL,
			'skipXss'	=> NULL,
			'isFrontend'=> NULL,
			'isBackend'	=> NULL,
			'isUser'	=> NULL,
			'menu'		=> FALSE,
			'enabled'	=> 1,
			'sections'	=> [],
			'shortcuts'	=> [],
			'isCore'	=> NULL,
			'isCurrent'	=> NULL,
			'currentVersion' => NULL,
			'updatedOn'	=> NULL
		];

		if (is_array($slug) || empty($slug))
		{
			return $nullArray;
		}

		$row = $this->db
			->where('slug', $slug)
			->get($this->table)
			->row();
		
		if ($row)
		{
            // store these
            $this->moduleExists[$slug] = count($row) > 0;
            $this->moduleEnabled[$slug] = $row->enabled;
            $this->moduleInstalled[$slug] = $row->installed;

			// Let's get REAL
			if ( ! $module = $this->spawnClass($slug, $row->isCore))
			{
				return FALSE;
			}

			list($class, $location) = $module;
			$info = $class->info();

			// Return FALSE if the module is disabled
			if ($row->enabled == 0)
			{
				return FALSE;
			}

			$name = ! isset($info['name'][CURRENT_LANGUAGE]) ? $info['name']['cn'] : $info['name'][CURRENT_LANGUAGE];
			$description = ! isset($info['description'][CURRENT_LANGUAGE]) ? $info['description']['cn'] : $info['description'][CURRENT_LANGUAGE];

			return [
				'slug' => $row->slug,
				'name' => $name,
				'description' => $description,
				'version' => $row->version,
				'skipXss' => $row->skipXss,
				'isFrontend' => $row->isFrontend,
				'isUser'	=> $row->isUser,
				'isBackend' => $row->isBackend,
				'menu' => $row->menu,
				'enabled' => (int)$row->enabled,
				'sections' => ! empty($info['sections']) ? $info['sections'] : [],
				'shortcuts' => ! empty($info['shortcuts']) ? $info['shortcuts'] : [],
				'isCore' => $row->isCore,
				'isCurrent' => version_compare($row->version, $class->version,  '>='),
				'currentVersion' => $class->version,
				'path' => $location,
				'updatedOn' => $row->updatedOn
			];
		}
		else
		{
			// store these, all are FALSE, since we couldn't find a module entry
			$this->moduleExists[$slug] = FALSE;
			$this->moduleEnabled[$slug] = FALSE;
			$this->moduleInstalled[$slug] = FALSE;
        }

		return $nullArray;
	}

	/**
	 * Get Modules
	 *
	 * Return an array of objects containing module related data
	 *
	 * @param   array   $params             The array containing the modules to load
	 * @param   bool    $returnDisabled    Whether to return disabled modules
	 * @return  array
	 */
	public function getAll($params = [], $returnDisabled = FALSE)
	{
		$modules = [];

		// We have some parameters for the list of modules we want
		if ($params)
		{
			foreach ($params as $field => $value)
			{
				if (in_array($field, ['isFrontend', 'isBackend', 'menu', 'isCore']))
				{
					$this->db->where($field, $value);
				}
			}
		}

		// Skip the disabled modules
		if ($returnDisabled === FALSE)
		{
			$this->db->where('enabled', 1);
		}

		$result = $this->db->get($this->table)->result();

		foreach ($result as $row)
		{
			// Let's get REAL
			if ( ! $module = $this->spawnClass($row->slug, $row->isCore))
			{
				// If module is not able to spawn a class,
				// just forget about it and move on, man.
				continue;
			}

			list($class, $location) = $module;
			$info = $class->info();
			$name = ! isset($info['name'][CURRENT_LANGUAGE]) ? $info['name']['cn'] : $info['name'][CURRENT_LANGUAGE];
			$description = ! isset($info['description'][CURRENT_LANGUAGE]) ? $info['description']['cn'] : $info['description'][CURRENT_LANGUAGE];
			$module = [
				'module'		=> $class,
				'slug'			=> $row->slug,
				'name'			=> $name,
				'description'	=> $description,
				'version'		=> $row->version,
				'skipXss'		=> $row->skipXss,
				'isFrontend'	=> $row->isFrontend,
				'isUser'	=> $row->isUser,
				'isBackend'		=> $row->isBackend,
				'isUser'		=> $row->isUser,
				'menu'			=> $row->menu,
				'enabled'		=> $row->enabled,
				'sections'		=> ! empty($info['sections']) ? $info['sections'] : [],
				'shortcuts'		=> ! empty($info['shortcuts']) ? $info['shortcuts'] : [],
				'installed'		=> $row->installed,
				'isCore'		=> $row->isCore,
				'isCurrent'		=> version_compare($row->version, $class->version,  '>='),
				'currentVersion'=> $class->version,
				'path'			=> $location,
				'updatedOn'		=> $row->updatedOn
			];
			
			// store these
			$this->moduleExists[$row->slug] = TRUE;
			$this->moduleEnabled[$row->slug] = $row->enabled;
			$this->moduleInstalled[$row->slug] = $row->installed;

			if ( ! empty($params['isBackend']))
			{
				// This user has no permissions for this module
				/*if ( $this->currentUser->groupName !== 'developer' && empty($this->permissions[$row->slug]) )
				{
					continue;
				}*/
			}

			$modules[$module['slug']] = $module;
		}

		ksort($modules);
		return array_values($modules);
	}

	/**
	 * Add
	 *
	 * Adds a module to the database
	 *
	 * @access	public
	 * @param	array	$module		Information about the module
	 * @return	object
	 */
	public function add($module)
	{
		return $this->db->replace($this->table, [
			'slug'			=> $module['slug'],
			'name'			=> $module['name'],
			'description'	=> $module['description'],
			'version'		=> $module['version'],
			'skipXss'		=> ! empty($module['skipXss']),
			'isFrontend'	=> ! empty($module['frontend']),
			'isUser'		=> ! empty($module['userinfo']),
			'isBackend'		=> ! empty($module['backend']),
			'menu'			=> ! empty($module['menu']) ? $module['menu'] : FALSE,
			'enabled'		=> ! empty($module['enabled']),
			'installed'		=> ! empty($module['installed']),
			'isCore'		=> ! empty($module['isCore']),
			'updatedOn'		=> time()
		]);
	}

	/**
	 * Update
	 *
	 * Updates a module in the database
	 *
	 * @access  public
	 * @param   array   $slug   Module slug to update
	 * @param   array   $module Information about the module
	 * @return  object
	 */
	public function update($slug, $module, $skip_validation = FALSE)
	{
		$module['updatedOn'] = time();

		return $this->db->where('slug', $slug)->update($this->table, $module);
	}

	/**
	 * Delete
	 *
	 * Delete a module from the database
	 *
	 * @param	array	$slug	The module slug
	 * @access	public
	 * @return	object
	 */
	public function delete($slug)
	{
		return $this->db->delete($this->table, ['slug' => $slug]);
	}

	/**
	 * Exists
	 *
	 * Checks if a module exists
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function exists($slug)
	{
		if ( ! $slug)
		{
			return FALSE;
		}

		// We already know about this module
		if (isset($this->moduleExists[$slug]))
		{
			return $this->moduleExists[$slug];
		}

		return $this->moduleExists[$slug] = $this->db
			->where('slug', $slug)
			->count_all_results($this->table) > 0;
	}
	
	/**
	 * Enabled
	 *
	 * Checks if a module is enabled
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function enabled($slug)
	{
		if ( ! $slug)
		{
			return FALSE;
		}

		// We already know about this module
		if (isset($this->moduleEnabled[$slug]))
		{
			return $this->moduleEnabled[$slug];
		}

		return $this->moduleEnabled[$slug] = $this->db
			->where('slug', $slug)
			->where('enabled', 1)
			->count_all_results($this->table) > 0;
	}
	
	
	/**
	 * Installed
	 *
	 * Checks if a module is installed
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function installed($slug)
	{
		if ( ! $slug)
		{
			return FALSE;
		}

		// We already know about this module
		if (isset($this->moduleInstalled[$slug]))
		{
			return $this->moduleInstalled[$slug];
		}

		return $this->moduleInstalled[$slug] = $this->db
			->where('slug', $slug)
			->where('installed', 1)
			->count_all_results($this->table) > 0;
	}

	/**
	 * Enable
	 *
	 * Enables a module
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function enable($slug)
	{
		if ($this->exists($slug))
		{
			$this->db->where('slug', $slug)->update($this->table, ['enabled' => 1]);
			$this->moduleEnabled[$slug] = TRUE;
			$this->moduleWidgetTask($slug, 'enable');

			return TRUE;
		}
		return FALSE;
	}
	
	
	/**
	 * Disable
	 *
	 * Disables a module
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function disable($slug)
	{
		if ($this->exists($slug))
		{
			$this->db->where('slug', $slug)->update($this->table, array('enabled' => 0));
			$this->moduleEnabled[$slug] = FALSE;
			$this->moduleWidgetTask($slug, 'disable');
			
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Install
	 *
	 * Installs a module
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function install($slug, $isCore = FALSE, $insert = FALSE)
	{
		if ( ! $module = $this->spawnClass($slug, $isCore))
		{
			return FALSE;
		}

		list($class) = $module;

		// They've just finished uploading it so we need to make a record
		if ($insert)
		{
			// Get some info for the db
			$input = $class->info();

			// Now lets set some details ourselves
			$input['slug']	= $slug;
			$input['name']			= serialize($input['name']);
			$input['description']	= serialize($input['description']);
			$input['version']		= $class->version;
			$input['enabled']		= $isCore; // enable if core
			$input['installed']		= $isCore; // install if core
			$input['isCore']		= $isCore; // is core if core

			// It's a valid module let's make a record of it
			$this->add($input);
		}
		
		// set the site_ref and upload_path for third-party devs
		/*$class->siteRef 	= SITE_PREFIX;
		$class->uploadPath	= 'uploads/'. SITE_PREFIX . '/';*/
		// Run the install method to get it into the database
		if ($class->install())
		{

			// TURN ME ON BABY!
			$this->db->where('slug', $slug)->update($this->table, ['enabled' => 1, 'installed' => 1]);
			
			// enable it
			$this->moduleExists[$slug] = TRUE;
			$this->moduleEnabled[$slug] = TRUE;
			$this->moduleInstalled[$slug] = TRUE;

			return TRUE;
		}

		return FALSE;
	}

	public function importUnknown()
    {
    	$modules = [];

		$isCore = TRUE;

		$known = $this->getAll([], TRUE);
		$knownArray = [];
		$knownMtime = [];

		// Loop through the known array and assign it to a single dimension because in_array can not search a multi array.
		if (is_array($known) && count($known) > 0)
		{
			foreach ($known as $item)
			{
				array_unshift($knownArray, $item['slug']);
				$knownMtime[$item['slug']] = $item;
			}
		}

		foreach ([BOONE, ADDONPATH] as $directory)
    	{
			// some servers return FALSE instead of an empty array
			if ( ! $directory or ! ($tempModules = glob($directory . 'application/*', GLOB_ONLYDIR)))
			{
				continue;
			}

			foreach ($tempModules as $path)
			{
				$slug = basename($path);

				// Yeah yeah we know
				if ( in_array($slug, $knownArray))
				{
					$detailsFile = $directory . 'application/' . $slug . '/module_' . $slug . EXT;

					if (file_exists($detailsFile) && filemtime($detailsFile) > $knownMtime[$slug]['updatedOn'] && $module = $this->spawnClass($slug, $isCore))
					{
						list($class) = $module;

						// Get some basic info
						$input = $class->info();

						$this->update($slug, [
							'name'			=> serialize($input['name']),
							'description'	=> serialize($input['description']),
							'isFrontend'	=> ! empty($input['frontend']),
							'isBackend'		=> ! empty($input['backend']),
							'isUser'		=> ! empty($input['user']),
							'skipXss'		=> ! empty($input['skipXss']),
							'menu'			=> ! empty($input['menu']) ? $input['menu'] : FALSE,
							'updatedOn'		=> time()
						]);

						log_message('debug', sprintf('The information of the module "%s" has been updated', $slug));
					}

					continue;
				}

				// This doesn't have a valid details.php file! :o
				if ( ! $module = $this->spawnClass($slug, $isCore))
				{
					continue;
				}

				list ($class) = $module;

				// Get some basic info
				$input = $class->info();
				// Now lets set some details ourselves
				$input['slug']      = $slug;
				$input['name']      = serialize($input['name']);
				$input['description']   = serialize($input['description']);
				$input['version']   = $class->version;
				$input['enabled']   = $isCore; // enable if core
				$input['installed'] = 0; // install if core
				$input['isCore']   = $isCore; // is core if core
				$input['isUser']   = $input['user']; // is core if core
				// Looks like it installed ok, add a record
				$this->add($input);
			}
			unset($tempModules);

			// Going back around, 2nd time is addons
			$isCore = FALSE;
		}

		return TRUE;
	}


	/**
	 * Spawn Class
	 *
	 * Checks to see if a details.php exists and returns a class
	 *
	 * @param	string	$slug	The folder name of the module
	 * @return	array
	 */
	private function spawnClass($slug, $isCore = FALSE)
	{
		$path = $isCore ? BOONE : ADDONPATH;

		// Before we can install anything we need to know some details about the module
		$detailsFile = $path . 'application/'.$slug.'/module_' . $slug . EXT;
		// Check the details file exists
		if ( ! is_file($detailsFile))
		{
			// we return FALSE to let them know that the module isn't here, keep looking
			return FALSE;
		}

		// Sweet, include the file
		include_once $detailsFile;

		// Now call the details class
		$class = 'Module_' . strtolower($slug);

		// Now we need to talk to it
		if ( ! class_exists($class))
		{
			throw new Exception("Module $slug has an incorrect details.php class. It should be called '$class'.");
		}

		return [new $class, dirname($detailsFile)];
	}

	/**
	 * Roles
	 *
	 * Retrieves roles for a specific module
	 *
	 * @param	string	$slug	The module slug
	 * @return	bool
	 */
	public function roles($slug)
	{
		foreach ([0, 1] as $isCore)
    	{
			//first try it as a core module
			if ($module = $this->spawnClass($slug, $isCore))
			{
				list($class) = $module;
				$info = $class->info();

				if ( ! empty($info['roles']))
				{
					$this->lang->load($slug . '/permission');
					return $info['roles'];
				}
			}
		}

		return [];
	}

	/**
	 * Help
	 *
	 * Retrieves version number from details.php
	 *
	 * @param   string  $slug   The module slug
	 * @return  bool
	 */
	public function version($slug)
	{
		if ($module = $this->spawnClass($slug, TRUE) or $module = $this->spawnClass($slug))
		{
			list($class) = $module;
			return $class->version;
		}

		return FALSE;
	}
	
}