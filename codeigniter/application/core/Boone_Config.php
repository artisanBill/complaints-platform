<?php
require APPPATH . "third_party/MX/Config.php";

class Boone_Config extends MX_Config
{
	/**
	 * Get subdomain.
	 *
	 * @var null
	 */
	protected static $subdomain = '';

	protected static $mainHost = '';

	/**
	 * Class constructor
	 *
	 * Sets the $config data from the primary config.php file as a class variable.
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->config =& get_config();

		// Set the base_url automatically if none was provided
		if (empty($this->config['base_url']))
		{
			// The regular expression is only a basic validation for a valid "Host" header.
			// It's not exhaustive, only checks for valid characters.
			if (isset($_SERVER['HTTP_HOST']) && preg_match('/^((\[[0-9a-f:]+\])|(\d{1,3}(\.\d{1,3}){3})|[a-z0-9\-\.]+)(:\d+)?$/i', $_SERVER['HTTP_HOST']))
			{
				$hostMain = $_SERVER['HTTP_HOST'];

				$allHost = explode('.', str_replace('www.', '', $hostMain));

				static::$mainHost = $allHost[0];

				if ( count($allHost) > 2 )
				{
					static::$subdomain = $allHost[0];
					static::$mainHost = $allHost[1];
				}

				$base_url = (is_https() ? 'https' : 'http') . '://' . $hostMain . substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
			}
			else
			{
				$base_url = 'http://localhost/';
			}

			$this->set_item('base_url', $base_url);
		}

		log_message('info', 'Config Class Initialized');
	}

	/**
	 * Return current Sub-domain.
	 *
	 * @return void.
	 */
	public static function subdomain()
	{
		return static::$subdomain;
	}

	/**
	 * [siteHost description]
	 * @return [type] [description]
	 */
	public static function siteHost()
	{
		return static::$mainHost;
	}
}