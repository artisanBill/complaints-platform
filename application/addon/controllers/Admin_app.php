<?php

class Admin_app extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'module';

	/**
	 * Constructor method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index method
	 * 
	 * @return void
	 */
	public function index()
	{
		$this->app_model->importUnknown();

		$allModules = $this->app_model->getAll(NULL, TRUE);

		$coreModules = $addonModules = [];
		foreach ($allModules as $module)
		{
			if ($module['isCore'])
			{
				$coreModules[] = $module;
			}
			else
			{
				$addonModules[] = $module;
			}
		}

		$this->template
			->title($this->moduleDetails['name'])
			->set('coreModules', $coreModules)
			->set('addonModules', $addonModules)
			->build('app/index');
	}

	public function info($slug = '')
	{
		$info = $this->app_model->get($slug);
		$this->template
			->set_layout(false)
			->set('info', $info)
			->build('app/info');
	}

	/**
	 * Upload
	 *
	 * Uploads an addon module
	 *
	 * @return	void
	 */
	public function upload()
	{
		if ( ! $this->settings->addonsUpload)
		{
			show_error('Uploading add-ons has been disabled for this site. Please contact your administrator');
		}
	}
	
	/**
	 * Uninstall
	 *
	 * Uninstalls an addon module
	 *
	 * @param	string	$slug	The slug of the module to uninstall
	 * @return	void
	 */
	public function uninstall($slug = '')
	{

		if ($this->app_model->uninstall($slug))
		{
			$this->session->set_flashdata('success', sprintf(lang('addons.modules.uninstall_success'), $slug));
			
			// Fire an event. A module has been disabled when uninstalled. 
			Events::trigger('module_disabled', $slug);
		}
		else
		{
			$this->session->set_flashdata('error', sprintf(lang('addons.modules.uninstall_error'), $slug));
		}

		redirect('addon');
	}

	/**
	 * Enable
	 *
	 * Enables an addon module
	 *
	 * @param	string	$slug	The slug of the module to enable
	 * @return	void
	 */
	public function install($slug)
	{
		if ($this->app_model->install($slug, TRUE))
		{
			// Fire an event. A module has been enabled when installed. 
			Events::trigger('module_enabled', $slug);
							
			$this->session->set_flashdata('success', sprintf(lang('addons.modules.installSuccess'), $slug));
		}
		else
		{
			$this->session->set_flashdata('error', sprintf(lang('addons.modules.installError'), $slug));
		}

		redirect('application/addon');
	}

	/**
	 * Enable
	 *
	 * Enables an addon module
	 *
	 * @param	string	$slug	The slug of the module to enable
	 * @return	void
	 */
	public function enable($slug)
	{
		if ($this->app_model->enable($slug))
		{
			// Fire an event. A module has been enabled. 
			Events::trigger('module_enabled', $slug);
			
			$this->session->set_flashdata('success', sprintf(lang('addons.modules.enableSuccess'), $slug));
		}
		else
		{
			$this->session->set_flashdata('error', sprintf(lang('addons.modules.enableError'), $slug));
		}

		redirect('addons/modules');
	}

	/**
	 * Disable
	 *
	 * Disables an addon module
	 *
	 * @param	string	$slug	The slug of the module to disable
	 * @return	void
	 */
	public function disable($slug)
	{
		if ($this->app_model->disable($slug))
		{
			// Fire an event. A module has been disabled. 
			Events::trigger('module_disabled', $slug);
			
			$this->session->set_flashdata('success', sprintf(lang('addons.modules.disableSuccess'), $slug));
		}
		else
		{
			$this->session->set_flashdata('error', sprintf(lang('addons.modules.disableError'), $slug));
		}

		redirect('admin/addons/modules');
	}
	
	/**
	 * Upgrade
	 *
	 * Upgrade an addon module
	 *
	 * @param	string	$slug	The slug of the module to disable
	 * @return	void
	 */
	public function upgrade($slug)
	{

	}

	/**
	 * Delete Recursive
	 *
	 * Recursively delete a folder
	 *
	 * @param	string	$str	The path to delete
	 * @return	bool
	 */
	private function deleteRecursive($str)
	{
        if (is_file($str))
		{
            return @unlink($str);
        }
		elseif (is_dir($str))
		{
            $scan = glob(rtrim($str,'/').'/*');

			foreach($scan as $index => $path)
			{
                $this->deleteRecursive($path);
            }

            return @rmdir($str);
        }
    }
}