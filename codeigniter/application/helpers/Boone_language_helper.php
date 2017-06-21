<?php

function getSupportedLang()
{
	$supported_lang = config_item('supportedLanguages');

	$arr = array();
	foreach ($supported_lang as $key => $lang)
	{
		$arr[] = $key . '=' . $lang['name'];
	}

	return $arr;
}

/**
 * Language Label
 *
 * Takes a string and checks for lang: at the beginning. If the
 * string does not have lang:, it outputs it. If it does, then
 * it will remove lang: and use the rest as the language line key.
 *
 * @param 	string
 * @return 	string
 */
if ( ! function_exists('langLabel'))
{
	function langLabel($key)
	{
		if (substr($key, 0, 5) == 'lang:')
		{
			return lang(substr($key, 5));
		}
		else
		{
			return $key;
		}
	}
}

if ( ! function_exists('sprintfLang'))
{
	function sprintfLang($line, $variables = array())
	{
		array_unshift($variables, lang($line));
		return call_user_func_array('sprintf', $variables);
	}
}