<?php defined('BOONE') OR exit('No direct script access allowed.');

function pickLanguage()
{
	require APPPATH.'/config/language.php';
	$sessionLibrary = NULL;

	//	Load CI session class, if is class not exists.
	if (function_exists('get_instance') && ! class_exists('session'))
	{
		$sessionLibrary = get_instance()->load->library('session');
	}

	if ( ! is_object($sessionLibrary->session) )
	{
		show_error('Class CI_Session not exists.', 500);
	}

	// Re-populate $_GET
	parse_str($_SERVER['QUERY_STRING'], $_GET);

	// If we've been redirected from HTTP to HTTPS on admin, ?session= will be set to maintain language
	if ($_SERVER['SERVER_PORT'] == 443 and ! empty($_GET['session']))
	{
		session_start($_GET['session']);
	}

	// Lang set in URL via ?lang=something
	if ( ! empty($_GET['lang']))
	{
		// Turn en-gb into en
		$lang = strtolower(substr($_GET['lang'], 0, 2));

		log_message('debug', 'Set language in URL via GET: '.$lang);
	}

	// Lang has already been set and is stored in a session
	elseif ( ! empty($sessionLibrary->session->userdata('langCode')))
	{
		$lang = $sessionLibrary->session->userdata('langCode');

		log_message('debug', 'Set language in Session: '. $lang);
	}

	// Lang has is picked by a user.
	elseif ( ! empty($_COOKIE['langCode']))
	{
		$lang = strtolower($_COOKIE['langCode']);

		log_message('debug', 'Set language in Cookie: '. $lang);
	}

	// Still no Lang. Lets try some browser detection then
	elseif ( $config['checkHttpAcceptLanguage'] and ! empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
	{
		// explode languages into array
		$acceptLangs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

		$supportedLangs = array_keys($config['supportedLanguages']);

		log_message('debug', 'Checking browser languages: '.implode(', ', $acceptLangs));

		// Check them all, until we find a match
		foreach ($acceptLangs as $acceptLang)
		{
			if (strpos($acceptLang, '-') === 2)
			{
				// Turn pt-br into br
				$lang = strtolower(substr($acceptLang, 3, 2));

				// Check its in the array. If so, break the loop, we have one!
				if (in_array($lang, $supportedLangs))
				{
					log_message('debug', 'Accept browser language: '.$acceptLang);

					break;
				}
			}

			// Turn en-gb into en
			$lang = strtolower(substr($acceptLang, 0, 2));

			// Check its in the array. If so, break the loop, we have one!
			if (in_array($lang, $supportedLangs))
			{
				log_message('debug', 'Accept browser language: ' . $acceptLang);
				break;
			}
		}
	}

	// If no language has been worked out - or it is not supported - use the default
	if (empty($lang) or ! array_key_exists($lang, $config['supportedLanguages']))
	{
		$lang = $config['supportedLanguages'];

		log_message('debug', 'Set language default: ' . $lang);
	}

	// Whatever we decided the lang was, save it for next time to avoid working it out again
	//$sessionLibrary->session->set_userdata('langCode', $lang);
	$sessionLibrary->session->set_userdata('langCode', 'cn');

	// Load CI config class
	$CIConfig =& load_class('Config');

	// Set the language config. Selects the folder name from its key of 'en'
	//$CIConfig->set_item('language', $config['supportedLanguages'][$sessionLibrary->session->userdata('langCode')]['folder']);

	// Sets a constant to use throughout ALL of CI.
	defined('AUTO_LANGUAGE') OR define('AUTO_LANGUAGE', $sessionLibrary->session->userdata('langCode'));

	log_message('debug', 'Defined const AUTO_LANGUAGE: '. AUTO_LANGUAGE);
}