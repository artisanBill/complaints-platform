<?php namespace Boone\Outshine\Traits;

use Closure, BadMethodCallException;

/**
 *	Class Macroable
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		Boone\Outshine\Traits\Macroable
 */
trait Macroable
{
	/**
	 *	The registered string macros.
	 *
	 *	@var		array
	 */
	protected static $macros = [];

	/**
	 *	Register a custom macros.
	 *
	 *	@param		string			$name
	 *	@param		callable		$macros
	 *	@return		void
	 */
	public static function macro($name, callable $macros)
	{
		static::$macros[$name] = $macros;
	}

	/**
	 *	Checks if macro is registered.
	 *
	 *	@param		string		$name
	 *	@return		boolean
	 */
	public static function hasMacro(string $name)
	{
		return isset(static::$macros[$name]);
	}

	/**
	 *	Dynamically hande calls to the class.
	 *
	 *	@param		string		$method
	 *	@param		array		$parameters
	 *	@return		mixed
	 *	@throws		BadMethodCallException
	 */
	public static function __callStatic(string $method, array $parameters)
	{
		if ( static::hasMacro($method) )
		{
			if ( static::$macros[$method] instanceof Closure )
			{
				return call_user_func_array(static::$macros[$method], NULL, get_called_class(), $parameters);
			}
			else
			{
				return call_user_func_array(static::$macros[$method], $parameters);
			}
		}

		throw new BadMethodCallException('Method {$method} does not exist.');
	}

	/**
	 *	Dynamically hande calls to the class.
	 *
	 *	@param		string		$method
	 *	@param		array		$parameters
	 *	@return		mixed
	 *	@throws		BadMethodCallException
	 */
	public function __call(string $method, array $parameters)
	{
		if ( ! static::hasMacro($method) )
		{
			throw new BadMethodCallException('Method {$method} does not exist.');
		}

		if ( static::$macros[$method] instanceof Closure )
		{
			return call_user_func_array(static::$macros[$method]->bindTo($this, get_class($this)), $parameters);
		}

		return call_user_func_array(static::$macros[$method], $parameters);
	}
}