<?php defined('BOONE') OR exit('No direct script access allowed.');

require APPPATH . "third_party/MX/Controller.php";

/**
 *	Class Boone_Controller
 *
 *	@link			http://boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		BooneCPS
 */

class Boone_Controller extends MX_Controller
{
	/**
	 * The name of the module that this controller instance actually belongs to.
	 *
	 * @var string 
	 */
	public $module;

	/**
	 * The name of the controller class for the current class instance.
	 *
	 * @var string
	 */
	public $controller;

	/**
	 * The name of the method for the current request.
	 *
	 * @var string 
	 */
	public $method;

	/**
	 * Load and set data for some common used libraries.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('member/member_teams_model');

		$this->benchmark->mark('boone_controller_start');

		// By changing the prefix we are essentially "namespacing" each site
		$this->db->set_dbprefix(SITE_PREFIX . '_');

		// Add the site specific theme folder
		$this->template->add_theme_location(BOONE . 'themes/');

		// Migration logic helps to make sure BooneCMS is running the latest changes
		/*$this->load->library('migration');
		if ( ! ($schemaVersion = $this->migration->current()))
		{
			show_error($this->migration->error_string());
		}

		// Result of schema version migration
		elseif (is_numeric($schemaVersion))
		{
			log_message('debug', 'Boone Web system was migrated to version: ' . $schemaVersion);
		}*/

		// With that done, load settings
		$this->load->library('settings/setting');

		// Set error log date format
		$this->config->set_item('log_date_format', Setting::get('dateFormat'));

		$siteLang = NULL;
		// Lock front-end language
		if ( ! (is_a($this, 'Admin_Controller') and ($siteLang = AUTO_LANGUAGE)))
		{
			$siteLanguage = explode(',', Setting::get('sitePublicLang'));

			if (in_array(AUTO_LANGUAGE, $siteLanguage))
			{
				$siteLang = AUTO_LANGUAGE;
			}
			else
			{
				$siteLang = Setting::get('siteLang');
			}
		}

		// We can't have a blank language. If there happens to be a blank language, let's default to English.
		if ( ! $siteLang )
		{
			$siteLang = 'cn';
		}
		// What language us being used
		defined('CURRENT_LANGUAGE') or define('CURRENT_LANGUAGE', $siteLang);

		$langs = $this->config->item('supportedLanguages');

		$booneLanguage['lang'] = $langs[CURRENT_LANGUAGE];
		$booneLanguage['lang']['code'] = CURRENT_LANGUAGE;
		$this->load->vars($booneLanguage);

		// Set php locale time
		if (isset($langs[CURRENT_LANGUAGE]['codes']) and sizeof($locale = (array) $langs[CURRENT_LANGUAGE]['codes']) > 1)
		{
			array_unshift($locale, LC_TIME);
			call_user_func_array('setlocale', $locale);
			unset($locale);
		}

		//$this->lang->load(['global', 'error']);

		// Reload languages
		/*if (AUTO_LANGUAGE !== CURRENT_LANGUAGE)
		{
			$this->config->set_item('language', $langs[CURRENT_LANGUAGE]['folder']);
			$this->lang->is_loaded = [];
			//$this->lang->load(array('errors', 'global', 'users/user', 'settings/settings', 'files/files'));
		}*/

		// Use this to define hooks with a nicer syntax
		get_instance()->hooks =& $GLOBALS['EXT'];

		// Work out module, controller and method and make them accessable throught the CI instance
		get_instance()->module = $this->module = $this->router->fetch_module();
		get_instance()->controller = $this->controller = $this->router->fetch_class();
		get_instance()->method = $this->method = $this->router->fetch_method();

		// Loaded after $this->currentUser is set so that data can be used everywhere
		$this->load->model([
			'addon/app_model',
			//'addons/theme_model',
		]);

		// load all modules (the Events library uses them all) and make their details widely available
		get_instance()->enabledModules = $this->app_model->getAll();

		// now that we have a list of enabled modules
		$this->load->library('events');

		// set defaults
		$this->template->moduleDetails = get_instance()->moduleDetails = $this->moduleDetails = FALSE;

		// now pick our current module out of the enabled modules array
		foreach (get_instance()->enabledModules as $module)
		{
			if ($module['slug'] === $this->module)
			{
				// Set meta data for the module to be accessible system wide
				$this->template->moduleDetails = get_instance()->moduleDetails = $this->moduleDetails = $module;

				break;
			}
		}

		// certain places (such as the Dashboard) we aren't running a module, provide defaults
		if ( ! $this->module)
		{
			$this->moduleDetails = [
				'slug' => NULL,
				'version' => NULL,
				'skipXss' => NULL,
				'isFrontend' => NULL,
				'isBackend' => NULL,
				'menu' => FALSE,
				'enabled' => 1,
				'sections' => [],
				'shortcuts' => [],
				'isCore' => NULL,
				'isCurrent' => NULL,
				'currentVersion' => NULL,
				'updatedOn' => NULL
			];
		}

		// If the module is disabled, then show a 404.
		//empty($this->moduleDetails['enabled']) AND show_404();

		if ( ! $this->moduleDetails['skipXss'])
		{
			$_POST = $this->security->xss_clean($_POST);
		}

		$this->load->vars($booneLanguage);
		
		$this->benchmark->mark('boone_controller_end');
	}
}