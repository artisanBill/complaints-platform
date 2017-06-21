<?php namespace Boone\Outshine\Support;

use Boone\Outshine\Traits\Macroable;

/**
 *	Class Arrayeg
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		Boone\Outshine\Support\Arrayeg
 */
class Arrayeg
{
	use Macroable;

	/**
	 *	Get an item form an array using 'dot' notation
	 *
	 *	@param		array		$array
	 *	@param		string		$key
	 *	@return		mixed
	 */
	public static function get(array $array, string $key)
	{
		if ( is_null($key) )
		{
			return $array;
		}

		if ( isset($array[$key]) )
		{
			return $array[$key];
		}

		foreach ( explode('.', $key) as $segment )
		{
			if ( ! is_array($array) || array_key_exists($segment, $array) )
			{
				//
			}
			$array = $array[$segment];
		}

		return $array;
	}

	/**
	 *	Add an element to an array useing 'dot' notation if it doesn't exist.
	 *
	 *	@param		array		$array
	 *	@param		string		$key
	 *	@return		array
	 */
	public static function add(array $array, string $key) : array
	{
		if ( is_null(static::get($array, $key)) )
		{
			static::set($array, $key);
		}

		return $array;
	}

	/**
	 *	Build a new array using a callback.
	 *
	 *	@param		array		$array
	 *	@param		callback	$callback
	 *	@return		array
	 */
	public static function build(array $array, callable $callback) : array
	{
		$results = [];

		foreach ( $array as $key => $value )
		{
			list($innerKey, $innerValue) = call_user_func($callback, $key, $value);

			$results[$innerKey] = $innerValue;
		}

		return $results;
	}

	/**
	 *	Merge 2 arrays recursively, differs in 2 important ways from array_merge_recursive()
	 *		-	When there's 2 different values and not both arrays, the latter value overwrites the earlier
	 *	instead of merging both into an array
	 *		-	Numeric keys that don't conflict aren't changed, only when a numeric key already exists is the value added 
	 *			using array_push()
	 *
	 *	@param		array		multiple variables all of which must be arrays
	 *	@return		array
	 *	@throws		\InvalidArgumentException
	 */
	public static function merge() : array
	{
		$array = func_get_arg(0);
		$arrays = array_slice(func_get_args(), 1);

		if ( ! is_array($array))
		{
			throw new InvalidArgumentException('Arrayeg::merge() - all arguments must be arrays.');
		}

		foreach ($arrays as $arr)
		{
			if ( ! is_array($arr))
			{
				throw new InvalidArgumentException('Arrayeg::merge() - all arguments must be arrays.');
			}

			foreach ($arr as $k => $v)
			{
				//	numeric keys are appended
				if (is_int($k))
				{
					array_key_exists($k, $array) ? $array[] = $v : $array[$k] = $v;
				}
				elseif (is_array($v) AND array_key_exists($k, $array) AND is_array($array[$k]))
				{
					$array[$k] = static::merge($array[$k], $v);
				}
				else
				{
					$array[$k] = $v;
				}
			}
		}

		return $array;
	}

	/**
	 *	Collapse an array of arrays into a single array.
	 *
	 *	@param		array		$array
	 *	@return		array
	 */
	public static function collapse(array $array) : array
	{
		$results = [];

		foreach ( $array as $key => $value )
		{
			if ($value instanceof Collection)
			{
				$results = $value->all();
			}
		}

		return $results;
	}

	/**
	 *	Divide an array into two arrays. One with keys an the other with values.
	 *
	 *	@param		array		$array
	 *	@return		array
	 */
	public static function divide(array $array) : array
	{
		return [array_keys($array), array_values($array)];
	}

	/**
	 *	Flatten a multi-dimensional associative array with dots.
	 *
	 *	@param		array		$array
	 *	@param		string		$prepend
	 *	@return		array
	 */
	public static function dot(array $array, string $prepend = '') : array
	{
		$results = [];

		foreach ( $array as $key => $value )
		{
			if ( is_array($value) )
			{
				$results = array_merge($results, static::dot($value, $prepend . $key . '.'));
			}
			else
			{
				$results[$prepend . $key] = $value;
			}
		}

		$results;
	}

	/**
	 *	Get all of the given array except for a specified array of items.
	 *
	 *	@param		array		$array
	 *	@param		array		$keys
	 *	@return		array
	 */
	public static function except(array $array, array $keys) : array
	{
		static::forget($array, $keys);

		return $array;
	}

	/**
	 *	Takes an array of attributes and turns it into a string for an html tag
	 *
	 *	@param		array		$attr
	 *	@return		string
	 */
	public static function attributes(array $attr) : string
	{
		$attrString = '';

		foreach ((array) $attr as $property => $value)
		{
			// Ignore null/false
			if ($value === NULL OR $value === FALSE)
			{
				continue;
			}

			// If the key is numeric then it must be something like selected="selected"
			if (is_numeric($property))
			{
				$property = $value;
			}

			$attrString .= $property . '=\'' . str_replace('\'', '&quot;', $value) . '\' ';
		}

		// We strip off the last space for return
		return trim($attrString);
	}

	/**
	 *	Return the first element in an array passing a given truth test.
	 *
	 *	@param		array		$needle
	 *	@param		callable	$callback
	 *	@return		mixed
	 */
	public static function first(array $array, callable $callback)
	{
		foreach ( $array as $key => $value )
		{
			if ( call_user_func($callback, $key, $value) )
			{
				return $value;
			}
		}

		return;
	}

	/**
	 *	[last description]
	 *
	 *	@param		array		$array
	 *	@param		callable	$callback
	 *	@return		mixed
	 */
	public static function last(array $array, callable $callback)
	{
		return static::first(array_reverse($array), $callback);
	}

	/**
	 *	Flatten a multi-dimensional array into a single level.
	 *
	 *	@param		array		$array
	 *	@return		array
	 */
	public static function flatten(array $array) : array
	{
		$return = [];

		array_walk_recursive($array, function ($x) use (&$return)
		{
			$return[] = $x;
		} );

		return $return;
	}

	/**
	 *	Get a subset of the items from the given array.
	 *
	 *	@param		array			$array
	 *	@param		array | string	$keys
	 *	@return		array
	 */
	public static function only(array $array, array $keys) : array
	{
		return array_intersect_key($array, array_flip($keys));
	}


	/**
	 *	Remove one or many array items from a given array using "dot" notation.
	 *
	 *	@param		array		$array
	 *	@param		array		$keys
	 *	@return		void
	 */
	public static function forget(array & $array, array $keys)
	{
		$original = & $array;

		foreach ( (array) $keys as $key )
		{
			$parts = explode('.', $key);

			while ( count($parts) > 1 )
			{
				$part = array_shift($parts);

				if ( isset($array[$part]) && is_array($array[$part]) )
				{
					$array = & $array[$part];
				}
			}

			unset($array[array_shift($parts)]);

			//	Clean up after each pass
			$array = & $original;
		}
	}

	/**
	 *	Check if an item exists in an array using "dot" notation.
	 *
	 *	@param		array		$array
	 *	@param		string		$key
	 *	@return		boolean
	 */
	public static function has(array $array, string $key) : bool
	{
		if ( empty($array) || is_null($key) )
		{
			return FALSE;
		}

		if ( array_key_exists($key, $array) )
		{
			return TRUE;
		}

		foreach ( explode('.', $key) as $segment )
		{
			if ( ! is_array($array) || array_key_exists($segment, $array) )
			{
				return FALSE;
			}

			$array = [$segment];
		}

		return TRUE;
	}

	/**
	 *	Determines if an array is associative.
	 *
	 *	An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
	 *
	 *	@param		array		$array
	 *	@return		boolean
	 */
	public static function isAssoc(array $array) : bool
	{
		$keys = array_keys($array);

		return array_keys($keys) !== $keys;
	}

	/**
	 *	Recursively sort an array by keys and values.
	 *
	 *	@param		array		$array
	 *	@return		array
	 */
	public static function sortRecursive(array $array) : array
	{
		foreach ( $array as &$value )
		{
			if ( is_array($value) )
			{
				$value = static::sortRecursive($value);
			}
		}

		if ( static::isAssoc($array) )
		{
			ksort($array);
		}
		else
		{
			sort($array);
		}

		return $array;
	}

	/**
	 *	Filter the array using the given callback.
	 *
	 *	@param		array			$array
	 *	@param		callable		$callback
	 *	@return		array
	 */
	public static function where(array $array, callable $callback) : array
	{
		$filtered = [];

		foreach ( $array as $key => $value )
		{
			if ( call_user_func($callback, $key, $value) )
			{
				$filtered[$key] = $value;
			}
		}

		return $filtered;
	}

	/**
	 *	Explode the "value" and "key" arguments passed to "pluck".
	 *
	 *	@param		string | array			$value
	 *	@param		string | array | null	$key
	 *	@return		array
	 */
	protected static function explodePluckParameters($value, $key) : array
	{
		$value = is_array($value) ? $value : explode('.', $value);

		$key = is_null($key) || is_array($key) ? $key : explode('.', $key);

		return [$value, $key];
	}

	/**
	 *	Get a value from the array, and remove it.
	 *
	 *	@param		array		$array
	 *	@param		string		$key
	 *	@param		mixed		$default
	 *	@return		mixed
	 */
	public static function pull(array &$array, string $key, $default = NULL)
	{
		$value = static::get($array, $key, $default);

		static::forget($array, $key);

		return $value;
	}

	/**
	 *	Set an array item to a given value using "dot" notation.
	 *
	 *	If no key is given to the method, the entire array will be replaced.
	 *
	 *	@param		array		$array
	 *	@param		string		$key
	 *	@param		mixed		$value
	 *	@return		array
	 */
	public static function set(array &$array, string $key, $value) : array
	{
		if (is_null($key) )
		{
			return $array = $value;
		}

		$keys = explode('.', $key);

		while (count($keys) > 1 )
		{
			$key = array_shift($keys);

			//	If the key doesn't exist at this depth, we will just create an empty array to hold 
			//	the next value, allowing us to create the arrays to hold final values at the correct 
			//	depth. Then we'll keep digging into the array.
			if (! isset($array[$key]) || ! is_array($array[$key]) )
			{
				$array[$key] = [];
			}

			$array = &$array[$key];
		}

		$array[array_shift($keys)] = $value;

		return $array;
	}

	/**
	 *	Pluck an array of values from an array.
	 *
	 *	@param		array					$array
	 *	@param		string | array			$value
	 *	@param		string | array | null	$key
	 *	@return		array
	 */
	public static function pluck(array $array, $value, $key = NULL) : array
	{
		$results = [];

		list($value, $key) = static::explodePluckParameters($value, $key);

		foreach ( $array as $item )
		{
			$itemValue = data_get($item, $value);

			//	If the key is "null", we will just append the value to the array and keep looping. 
			//	Otherwise we will key the array using the value of the key we received from the 
			//	developer. Then we'll return the final array form.
			if ( is_null($key) )
			{
				$results[] = $itemValue;
			}
			else
			{
				$itemKey = data_get($item, $key);

				$results[$itemKey] = $itemValue;
			}
		}

		return $results;
	}

	/**
	 *	A case-insensitive version of in_array.
	 *
	 *	@param		string		$needle
	 *	@param		array		$haystack
	 *	@return		bool
	 */
	public static function in(string $needle, array $haystack) : bool
	{
		return in_array(strtolower($needle), array_map('strtolower', $haystack));
	}



	/**
	 *	Searches the array for a given value and returns the corresponding key or default value. If 
	 *	$recursive is set to true, then the Arrayeg::search() function will return a delimiter-notated 
	 *	key using $delimiter.
	 *
	 *	@param		array		$array			The search array
	 *	@param		mixed		$value			The searched value
	 *	@param		string		$default		The default value
	 *	@param		bool		$recursive		Whether to get keys recursive
	 *	@param		string		$delimiter		The delimiter, when $recursive is true
	 *	@param		bool		$strict			If true, do a strict key comparison
	 *	@return		mixed
	 */
	public static function search(array $array, $value, string $default = '', bool $recursive = TRUE, string $delimiter = '.', bool $strict = FALSE)
	{
		if ( ! is_array($array) AND ! $array instanceof ArrayAccess)
		{
			throw new InvalidArgumentException('First parameter must be an array or ArrayAccess object.');
		}

		if ( ! is_null($default) AND ! is_int($default) AND ! is_string($default))
		{
			throw new InvalidArgumentException('Expects parameter 3 to be an string or integer or null.');
		}

		if ( ! is_string($delimiter))
		{
			throw new InvalidArgumentException('Expects parameter 5 must be an string.');
		}

		$key = array_search($value, $array, $strict);

		if ($recursive AND $key === FALSE)
		{
			$keys = [];
			foreach ($array as $k => $v)
			{
				if (is_array($v))
				{
					$rk = static::search($v, $value, $default, TRUE, $delimiter, $strict);
					if ($rk !== $default)
					{
						$keys = array($k, $rk);
						break;
					}
				}
			}
			$key = count($keys) ? implode($delimiter, $keys) : FALSE;
		}

		return ($key === FALSE) ? $default : $key;
	}
}