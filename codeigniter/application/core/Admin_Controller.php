<?php defined('BOONE') OR exit('No direct script access allowed.');

/**
 *	Class Boone_Controller
 *
 *	@link			http://cms.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 */
class Admin_Controller extends Boone_Controller
{
	/**
	 * Admin controllers can have sections, normally an arbitrary string
	 *
	 * @var string
	 */
	public $section = NULL;

	/**
	 * Load language, check flashdata, define https, load and setup the data for the admin theme
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users/user_model');

		// Get current user data
		$this->template->currentUser = get_instance()->currentUser = $this->currentUser = $this->user_model->getUser();

		$this->lang->load('nav');

		if ( $this->checkAccess() === FALSE )
		{
			$this->session->set_flashdata('error', '您没有权限访问.');
			redirect();
		}

		// If the setting is enabled redirect request to HTTPS
		if ($this->setting->adminForceHttps and strtolower(substr(current_url(), 4, 1)) != 's')
		{
			redirect(str_replace('http:', 'https:', current_url()) .'?session=' . session_id());
		}

		// Active Admin Section (might be null, but who cares)
		$this->template->activeSection = $this->section;

		if ( isset($this->currentUser->id) )
		{
			$menuItems = [];
			// This array controls the order of the admin items.
			$this->template->menuOrder = [
				'home'			=> 'home',
				'database'		=> 'data',
				'sitemap'		=> 'structure',
				'puzzle-piece'	=> 'application',
				'cubes'			=> 'content',
				'user'			=> 'root',
				'gears'			=> 'setting'
			];

			$modules = $this->app_model->getAll([
				'isBackend' => TRUE,
			]);

			foreach ($modules as $module)
			{
				// If we do not have an admin_menu function, we use the regular way of checking out the details.php data.
				if ( $module['module'] )
				{
					// Legacy module routing. This is just a rough re-route and modules should change using their upgrade() details.php functions.
					if ($module['menu'] == 'utilities') $module['menu'] = 'data';
					if ($module['menu'] == 'design') $module['menu'] = 'structure';

					$menuItems[$module['menu']][$module['name']] = $module['menu'] . '/' . $module['slug'];

					// If a module has an admin_menu function, then we simply run that and allow it to manipulate the menu array.
					if (method_exists($module['module'], 'adminMenu'))
					{
						$module['module']->adminMenu($menuItems);
					}
				}
			}

			foreach ($this->template->menuOrder as $order)
			{
				if (isset($menuItems[$order]))
				{
					$orderedMenu[$order] = $menuItems[$order];
					unset($menuItems[$order]);
				}
			}

			// Any stragglers?
			if ($menuItems)
			{
				$translatedMenuItems = [];

				// translate any additional top level menu keys so the array_merge works
				foreach ($menuItems as $key => $menuItem)
				{
					$translatedMenuItems[$key] = $menuItem;
				}
				$orderedMenu = array_merge_recursive($orderedMenu, $translatedMenuItems);
			}

			// And there we go! These are the admin menu items.
			if ( isset($orderedMenu[$this->uri->segment(1)]) )
			{
				$this->template->submenuItems = $orderedMenu[$this->uri->segment(1)];
			}
		}

		// Enable profiler on local box
		if ((isset($this->currentUser->groupName) && $this->currentUser->groupName === 'developer') && is_array($_GET) && array_key_exists('debug', $_GET))
		{
			unset($_GET['debug']);
			$this->output->enable_profiler(true);
		}

		$this->template
			->enable_parser(FALSE)
			->set_theme('admin')
			->set_layout('default');
	}

	/**
	 * Checks to see if a user object has access rights to the admin area.
	 *
	 * @return boolean 
	 */
	private function checkAccess()
	{
		// These pages get past permission checks
		$ignoredPages = ['', 'logout'];

		// Check if the current page is to be ignored
		$this->currentPage = $this->uri->segment(1);

		// Dont need to log in, this is an open page
		if (in_array($this->currentPage, $ignoredPages) OR ! $this->currentPage)
		{
			return TRUE;
		}

		if ( ! $this->currentUser)
		{
			// save the location they were trying to get to
			$this->session->set_userdata('adminRedirect', $this->uri->uri_string());
			return FALSE;
		}

		// Admins can go straight in
		if ( $this->currentUser->groupName == 'developer' )
		{
			return TRUE;
		}

		// Well they at least better have permissions!
		if ($this->currentUser)
		{
            // Check if the current user can view that page
            //return array_key_exists($this->module, $this->permissions);
		}

		// god knows what this is... erm...
		return FALSE;
	}
}