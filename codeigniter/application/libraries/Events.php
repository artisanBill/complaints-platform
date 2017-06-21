<?php

class Events
{
	/**
	 * An array of listeners
	 * 
	 * @var	array
	 */
	protected static $listeners = [];

	/**
	 * Constructor
	 * 
	 * Load up the application. 
	 */
	public function __construct()
	{
		$boone = get_instance();

		$isCore = TRUE;

		$boone->load->model('addon/app_model');

		if ( ! ($results = $boone->enabledModules))
		{
			return FALSE;
		}

		foreach ($results as $row)
		{
			// This does not have a valid details.php file! :o
			if (! $detailsClass = static::spawnClass($row['slug'], $row['isCore']))
			{
				continue;
			}
		}

		return TRUE;
	}

	/**
	 * Spawn Class
	 *
	 * Checks to see if a events.php exists and returns a class
	 * 
	 * @param string $slug The folder name of the module.
	 * @param boolean $isCore Whether the module is a core module.
	 * @return object|boolean 
	 */
	private static function spawnClass($slug, $isCore = true)
	{
		$path = $isCore ? APPPATH : ADDONPATH;

		// Before we can install anything we need to know some details about the module
		$eventsFile = $path . 'application/' . $slug . '/events' . EXT;

		// Check the details file exists
		if ( ! is_file($eventsFile))
		{
			$eventsFile = ADDONPATH . 'application/' . $slug . '/events'.EXT;

			if ( ! is_file($eventsFile))
			{
				return FALSE;
			}
		}

		// Sweet, include the file
		include_once $eventsFile;

		// Now call the details class
		$class = 'Events'.ucfirst(strtolower($slug));

		// Now we need to talk to it
		return class_exists($class) ? new $class : false;
	}

	/**
	 * Register
	 *
	 * Registers a Callback for a given event
	 *
	 * @param string $event The name of the event.
	 * @param array $callback The callback for the event.
	 */
	public static function register($event, array $callback)
	{
		$key = get_class($callback[0]).'::'.$callback[1];
		static::$listeners[$event][$key] = $callback;
		log_message('debug', 'Events::register() - Registered "'.$key.' with event "'.$event.'"');
	}

	/**
	 * Triggers an event and returns the results.
	 * 
	 * The results can be returned in the following formats:
	 *  - 'array'
	 *  - 'json'
	 *  - 'serialized'
	 *  - 'string'
	 *
	 * @param string $event The name of the event
	 * @param string $data Any data that is to be passed to the listener
	 * @param string $return_type The return type
	 * @return string|array The return of the listeners, in the return type
	 */
	public static function trigger($event, $data = '', $return_type = 'string')
	{
		log_message('debug', 'Events::trigger() - Triggering event "'.$event.'"');

		$calls = [];

		if (static::hasListeners($event))
		{
			foreach (static::$listeners[$event] as $listener)
			{
				if (is_callable($listener))
				{
					$calls[] = call_user_func($listener, $data);
				}
			}
		}

		return static::formatReturn($calls, $return_type);
	}

	/**
	 * Format Return
	 *
	 * Formats the return in the given type
	 *
	 * @param array $calls The array of returns
	 * @param string $return_type The return type
	 * @return array|null The formatted return
	 */
	protected static function formatReturn(array $calls, $return_type)
	{
		log_message('debug', 'Events::formatReturn() - Formating calls in type "'.$return_type.'"');

		switch ($return_type)
		{
			case 'array':
				return $calls;
				break;
			case 'json':
				return json_encode($calls);
				break;
			case 'serialized':
				return serialize($calls);
				break;
			case 'string':
				$str = '';
				foreach ($calls as $call)
				{
					$str .= $call;
				}
				return $str;
				break;
			default:
				return $calls;
				break;
		}

		// Does not do anything, so send null. false would suggest an error
		return null;
	}

	/**
	 *
	 * @param	string	
	 * @return	bool	
	 */

	/**
	 * Checks if the event has listeners
	 *
	 * @param string $event The name of the event
	 * @return boolean Whether the event has listeners
	 */
	public static function hasListeners($event)
	{
		log_message('debug', 'Events::hasListeners() - Checking if event "'.$event.'" has listeners.');

		if (isset(static::$listeners[$event]) and count(static::$listeners[$event]) > 0)
		{
			return TRUE;
		}

		return false;
	}

}