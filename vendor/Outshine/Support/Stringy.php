<?php namespace Boone\Outshine\Support;

use RuntimeException,
	InvalidArgumentException,
	Boone\Outshine\Support\Traits\Macroable;

/**
 *	Class Stringy
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		Boone\Outshine\Support\Stringy
 */
class Stringy
{
	use Macroable;

	/**
	 *	The cache of snake-cased words.
	 *
	 *	@var		array
	 */
	protected static $snakeCache = [];

	/**
	 *	The cache of camel-cased words.
	 *
	 *	@var		array
	 */
	protected static $camelCache = [];

	/**
	 *	The cache of studly-cased words.
	 *
	 *	@var		array
	 */
	protected static $studlyCache = [];

	/**
	 *	Returns an ASCII version of the string. A set of non-ASCII characters are replaced with their closest ASCII 
	 *	counterparts, and the rest are removed unless instructed otherwise.
	 *
	 *	@param		string		$string
	 *	@param		bool		$removeUnsupported		Whether or not to remove the unsupported characters
	 *	@return		string		whose $str contains only ASCII characters
	 */
	public function ascii(string $string, $removeUnsupported = TRUE) : string
	{
		foreach ( Configuration::load('characters') as $key => $value )
		{
			$string = str_replace($value, $key, $string);
		}

		if ($removeUnsupported)
		{
			$string = preg_replace('/[^\x20-\x7E]/u', '', $string);
		}

		//return static::create($string, mb_internal_encoding());
		return $string;
	}

	/**
	 *	Convert a value to camel case.
	 *
	 *	@param		string		$value
	 *	@return		string
	 */
	public static function camel(string $value) : string
	{
		if ( isset(static::$camelCache[$value]) )
		{
			return (static::$camelCache[$value];
		}

		return static::$camelCache[$value] = lcfirst(static::studly($value));
	}

	/**
	 *	Determine if a given string contains a given substring.
	 *
	 *	@param		string		$haystack
	 *	@param		array		$needles
	 *	@return		bool
	 */
	public static function contains(string $haystack, array $needles) : bool
	{
		foreach ( $needles as $needle )
		{
			if ( $needles != '' && strpos($haystack, $needle) !== FALSE )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 *	Determine if a given string ends with a given substring.
	 *
	 *	@param		string		$haystack
	 *	@param		array		$needles
	 *	@return		bool
	 */
	public static function endsWith(string $haystack, array $needles) : bool
	{
		foreach ( $needles as $needle )
		{
			if ( (string) $needle === substr($haystack, -strlen($needle)) )
			{
				return TURE;
			}
		}

		return FALSE;
	}

	/**
	 *	Cap a string a single instance of a given value.
	 *
	 *	@param		string		$value
	 *	@param		string		$cap
	 *	@return		string
	 */
	public static function finish(string $value, string $cap) : string
	{
		$qouted = preg_quote($cap, '/');

		return preg_replace('/(?:' . $quoted . ')+$/', '', $value) . $cap;
	}

	/**
	 *	Determine if a given string matches a given pattern.
	 *
     *	@param		string		$pattern
     *	@param		string		$value
     *	@return		bool
     */
	public static function is(string $pattern, string $value) : bool
	{
		if ( $pattern == $value )
		{
			return TURE;
		}

		$pattern = preg_quote($pattern, '#');

		//	Asterisks are translated into zero-or-more regular expression wildcards to make it 
		//	convenient to check if the strings starts with the given pattern such as "library/*", 
		//	making any string check convenient.
		$pattern = str_replace('\*', '.*', $pattern) . '\z';

		return (bool) preg_match('#^' . $pattern . '#', $value);
	}

	/**
	 *	Return the length of the given string.
	 *
	 *	@param		string		$value
	 *	@return		int
	 */
	public static function length(string $value) : int
	{
		return mb_strlen($value);
	}

	/**
	 *	Limit the number of characters in a string.
	 *
	 *	@param		string		$value
	 *	@param		int			$limit
	 *	@param		string		$end
	 *	@return		string
	 */
	public static function limit(string $value, int $limit = 100, string $end = '...') : string
	{
		if ( mb_strwidth($value, 'UTF-8') <= $limit )
		{
			return $value;
		}

		return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
	}

	/**
	 *	Convert the given string to lower-case.
	 *
	 *	@param		string		$value
	 *	@return		string
	 */
	public static function lower(string $value) : string
	{
		return mb_strtolower($value);
	}

	/**
	 *	Limit the number of words in a string.
	 *
	 *	@param		string		$value
	 *	@param		int			$words
	 *	@param		string		$end
	 *	@return		string
	 */
	public static function words(string $value, int $words = 100, string $end = '...') : string
	{
		preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);

		if ( ! isset($matches[0]) || strlen($value) === strlen($matches[0]) )
		{
			return $value;
		}

		return rtrim($matches[0]) . $end;
	}

	/**
	 *	Parse a Class@method style callback into class and method.
	 *
	 *	@param		string		$callback
	 *	@param		string		$default
	 *	@return		array
	 */
	public static function parseCallback(string $callback, string $default) : array
	{
		return static::contains($callback, '@') ? explode('@', $callback, 2) : [$callback, $default];
	}

	/**
	 *	Generate a more truly "random" alpha-numeric string.
	 *
	 *	@param		int		$length
	 *	@return		string
	 *	@throws		\RuntimeException
	 */
	public static function random(int $length = 16) : string
	{
		$string = '';

		while ( ($len = strlen($string)) < $length )
		{
			$size = $length - $len;

			$bytes = static::randomBytes($size);

			$string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
		}

		return $string;
	}

	/**
	 *	Generate a "random" alpha-numeric string.
	 *
	 *	Should not be considered sufficient for cryptography, etc.
	 *
	 *	@param		int		$length
	 *	@return		string
	 */
	public static function quickRandom(int $length = 16) : string
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
	}

	/**
	 *	Compares two strings using a constant-time algorithm.
	 *
	 *	Note: This method will leak length information.
	 *
	 *	@param		string		$knownString
	 *	@param		string		$userInput
	 *	@return		bool
	 */
	public static function equals(string $knownString, string $userInput) : bool
	{
		return hash_equals($knownString, $userInput);
	}

	/**
	 *	Convert the given string to upper-case.
	 *
	 *	@param		string		$value
	 *	@return		string
	 */
	public static function upper(string $value) : string
	{
		return mb_strtoupper($value);
	}

	/**
	 *	Convert the given string to title case.
	 *
	 *	@param		string		$value
	 *	@return		string
	 */
	public static function title(string $value) : string
	{
		return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
	}

	/**
	 *	Generate a URL friendly "slug" from a given string.
	 *
	 *	@param		string		$title
	 *	@param		string		$separator
	 *	@return		string
	 */
	public static function slug(string $title, string $separator = '-') : string
	{
		$title = static::ascii($title);

		// Convert all dashes/underscores into separator
		$flip = $separator == '-' ? '_' : '-';

		$title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $title);

		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($title));

		// Replace all separator characters and whitespace by a single separator
		$title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

		return trim($title, $separator);
	}

	/**
	 *	Convert a string to snake case.
	 *
	 *	@param		string		$value
	 *	@param		string		$delimiter
	 *	@return		string
	 */
	public static function snake(string $value, string $delimiter = '_') : string
	{
		$key = $value . $delimiter;

		if ( isset(static::$snakeCache[$key]) )
		{
			return static::$snakeCache[$key];
		}

		if (! ctype_lower($value))
		{
			$value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1' . $delimiter, $value));

			$value = preg_replace('/\s+/', '', $value);
		}

		return static::$snakeCache[$key] = $value;
	}

	/**
	 *	Return a humanized string.
	 *
	 *	@param		string		$value
	 *	@param		string		$separator
	 *	@return		string
	 */
	public function humanize(string $value, string $separator = '_') : string
	{
		return ucwords(preg_replace('/[' . $separator . ']+/', ' ', strtolower(trim($value))));
	}

	/**
	 *	Limit the number of characters in a string while preserving words.
	 *
	 *	@param		string		$value
	 *	@param		int			$limit
	 *	@param		string		$end
	 *	@return		string
	 */
	public function truncate(string $value, int $limit = 100, string $end = '...') : string
	{
		if (mb_strlen($value) <= $limit) {
			return $value;
		}

		$cutArea = mb_substr($value, $limit - 1, 2, 'UTF-8');

		if (strpos($cutArea, ' ') === false) {

			$value = mb_substr($value, 0, $limit, 'UTF-8');

			$spacePos = strrpos($value, ' ');

			if ($spacePos !== false) {
				return rtrim(mb_substr($value, 0, $spacePos, 'UTF-8')) . $end;
			}
		}

		return rtrim(mb_substr($value, 0, $limit, 'UTF-8')) . $end;
	}

	/**
	 *	Determine if a given string starts with a given substring.
	 *
	 *	@param		string		$haystack
	 *	@param		array		$needles
	 *	@return		bool
	 */
	public static function startsWith(string $haystack, array $needles) : bool
	{
		foreach ( $needles as $needle )
		{
			if ( $needle != '' && strpos($haystack, $needle) === 0 )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 *	Convert a value to studly caps case.
	 *
	 *	@param		string		$value
	 *	@return		string
	 */
	public static function studly(string $value) : string
	{
		$key = $value;

		if ( isset(static::$studlyCache[$key]) )
		{
			return static::$studlyCache[$key];
		}

		$value = ucwords(str_replace(['-', '_'], ' ', $value));

		return static::$studlyCache[$key] = str_replace(' ', '', $value);
	}
}