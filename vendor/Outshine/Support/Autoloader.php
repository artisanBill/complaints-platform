<?php namespace Boone\Outshine\Support;

use RuntimeException;

/**
 *	Class Autoloader
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		Boone\Outshine\Support\Autoloader
 */
class Autoloader
{
	/**
	 *	Holds all the classes and paths
	 *
	 *	@var		array
	 */
	protected static $classes = [];

	/**
	 *	Holds all the namespace paths
	 *
	 *	@var		array
	 */
	protected static $namespaces = [];

	/**
	 *	Holds all the PSR-0 compliant namespaces. These namespaces should be loaded according to the PSR-0 standard.
	 *
	 *	@var  array
	 */
	protected static $psrNamespaces = [];

	/**
	 *	Path to autoloader
	 *
	 *	@var		array
	 */
	protected static $paths = [];

	/**
	 *	List off namespaces of which classes will be aliased to global namespace
	 *
	 *	@var		array
	 */
	protected static $coreNamespaces = [];

	/**
	 *	the default path to look in if the class is not in a package
	 *
	 *	@var		array
	 */
	protected static $defaultPath = [];

	/**
	 *	whether to initialize a loaded class
	 *
	 *	@var		boolean
	 */
	protected static $autoInitialize = NULL;

	/**
	 *	Adds a namespace search path.  Any class in the given namespace will be looked for in the given path.
	 *
	 *	@param		string		the namespace
	 *	@param		string		the path
	 *	@return		void
	 */
	public static function addNamespace($namespace, $path, $psr = FALSE)
	{
		static::$namespaces[$namespace] = $path;
		if ( $psr ) 
		{
			static::$psrNamespaces[$namespace] = $path;
		}
	}

	/**
	 *	Adds an array of namespace paths. See {addNamespace}.
	 *
	 *	@param		array		the namespaces
	 *	@param		bool		whether to prepend the namespace to the search path
	 *	@return		void
	 */
	public static function addNamespaces(array $namespaces, $prepend = FALSE)
	{
		if ( ! $prepend ) 
		{
			static::$namespaces = array_merge(static::$namespaces, $namespaces);
		}
		else
		{
			static::$namespaces = $namespaces + static::$namespaces;
		}
	}

	/**
	 *	Returns the namespace's path or FALSE when it doesn't exist. 
	 *
	 *	@param		string			the namespace to get the path for
	 *	@return		array | bool	the namespace path or FALSE
	 */
	public static function namespacePath($namespace)
	{
		if ( ! array_key_exists($namespace, static::$namespaces) ) 
		{
			return FALSE;
		}

		return static::$namespaces[$namespace];
	}

	/**
	 *	Adds multiple class paths to the load path. See :.
	 *
	 *	@see		Autoloader::addClass
	 *
	 *	@param		array		the class names and paths
	 *	@return		void
	 */
	public static function addClasses(array $classes)
	{
		foreach ( $classes as $class => $path ) 
		{
			static::$classes[ucfirst($class)] = $path;
		}
	}

	/**
	 *	Aliases the given class into the given Namespace.  By default it will add it to the global namespace.
	 *
	 *	@param		string		the class name
	 *	@param		string		the namespace to alias to
	 */
	public static function aliasToNamespace($class, $namespace = NULL) : string
	{
		empty($namespace) || $namespace = rtrim($namespace, '\\') . '\\';
		$parts = explode('\\', $class);
		$rootClass = $namespace . array_pop($parts);
		class_alias($class, $rootClass);
	}

	/**
	 *	Register's the autoloader to the SPL autoload stack.
	 *
	 *	@return		void
	 */
	public static function register()
	{
		spl_autoload_register('Boone\Outshine\Support\Autoloader::load', TRUE, TRUE);
	}

	/**
	 *	Returns the class with namespace prefix when available
	 *
	 *	@param		string
	 *	@return		bool|string
	 */
	protected static function findCoreClass($class)
	{
		foreach ( static::$coreNamespaces as $namespaces ) 
		{
			if ( array_key_exists(ucfirst($namespaceClass = $namespaces . '\\' . $class), static::$classes) ) 
			{
				return $namespaceClass;
			}
		}

		return FALSE;
	}

	/**
	 *	Add a namespace for which classes may be used without the namespace prefix and will be auto-aliased to the global namespace.
	 *	Prefixing the classes will overwrite core classes and previously added namespaces.
	 *
	 *	@param		string
	 *	@param		bool
	 *	@return		void
	 */
	public static function addCoreNamespace($namespace, $prefix = TRUE)
	{
		if ( $prefix ) 
		{
			array_unshift(static::$coreNamespaces, $namespace);
		}
		else
		{
			static::$coreNamespaces[] = $namespace;
		}
	}

	/**
	 *	Loads a class.
	 *
	 *	@param		string		Class to load
	 *	@return		boolean		If it loaded the class
	 */
	public static function load($class) : bool
	{
		/*	deal with funny is_callable('static::classname') side-effect	*/
		if ( strpos($class, 'static::') === 0 ) 
		{
			/*	is called from within the class, so it's already loaded	*/
			return TRUE;
		}

		$loaded = FALSE;
		$class = ltrim($class, '\\');
		$namespaced = ($pos = strripos($class, '\\')) !== FALSE;

		if ( empty(static::$autoInitialize) ) 
		{
			static::$autoInitialize = $class;
		}

		if ( isset(static::$classes[ucfirst($class)]) ) 
		{
			static::initializeClass($class, str_replace('/', DIRECTORY_SEPARATOR, static::$classes[ucfirst($class)]));
			$loaded = TRUE;
		}
		elseif ( $brocadeClasses = static::findCoreClass($class) )
		{
			if ( ! class_exists($brocadeClasses, FALSE) AND ! interface_exists($brocadeClasses, FALSE)) 
			{
				include static::prepPath(static::$classes[ucfirst($brocadeClasses)]);
			}
			if ( ! class_exists($class, FALSE) ) 
			{
				class_alias($brocadeClasses, $class);
			}
			static::initializeClass($class);
			$loaded = TRUE;
		}
		else
		{
			$brocadeNamespace = substr($class, 0, $pos);

			if ( $brocadeNamespace) 
			{
				foreach ( static::$namespaces as $namespace => $path ) 
				{
					$namespace = ltrim($namespace, '\\');

					if ( stripos($brocadeNamespace, $namespace) === 0 ) 
					{
						$path .= static::classToPath( substr($class, strlen($namespace) + 1), array_key_exists($namespace, static::$psrNamespaces));

						if ( is_file($path) ) 
						{
							static::initializeClass($class, $path);
							$loaded = TRUE;
							break;
						}
					}
				}
			}

			if (  ! $loaded )
			{
				/*$path = WEBSITE . DIRECTORY_SEPARATOR . ucfirst('controller') . DIRECTORY_SEPARATOR . static::classToPath($class);

				if ( is_file($path)) 
				{
					static::initializeClass($class, $path);
					$loaded = TRUE;
				}*/
			}
		}

		/*	Prevent failed load from keeping other classes from initializing	*/
		if ( static::$autoInitialize == $class ) 
		{
			static::$autoInitialize = NULL;
		}

		return $loaded;
	}

	/**
	 *	Reset the auto initialize state after an autoloader exception. This method is called by the exception handler, and is considered an
	 *	internal method!
	 */
	public static function reset()
	{
		static::$autoInitialize = NULL;
	}

	/**
	 *	Takes a class name and turns it into a path.  It follows the PSR-0 standard, except for makes the entire path lower case, unless you tell
	 *	it otherwise.
	 *
	 *	Note: This does not check if the file exists...just gets the path
	 *
	 *	@param		string		Class name
	 *	@param		bool		Whether this is a PSR-0 compliant class
	 *	@return		string		Path for the class
	 */
	protected static function classToPath($class, $psr = FALSE)
	{
		$file  = '';
		if ( $lastNsPos = strripos($class, '\\') ) 
		{
			$namespace = substr($class, 0, $lastNsPos);
			$class = substr($class, $lastNsPos + 1);
			$file = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$file .= $class . '.php';

		if (  ! $psr ) 
		{
			$file = ucfirst($file);
		}

		return $file;
	}

	/**
	 *	Checks to see if the given class has a static initialize() method.  If so then it calls it.
	 *
	 *	@param		string		the class name
	 *	@param		string		the file containing the class to include
	 */
	protected static function initializeClass($class, $file = NULL)
	{
		/*	include the file if needed	*/
		if ( $file ) 
		{
			include $file;
		}

		/*	if the loaded file contains a class...	*/
		if ( class_exists($class, FALSE)) 
		{
			/*	call the classes static initialize if needed	*/
			if ( static::$autoInitialize === $class ) 
			{
				static::$autoInitialize = NULL;
				if ( method_exists($class, 'initialize') AND is_callable($class . '::initialize')) 
				{
					call_user_func($class . '::initialize');
				}
			}
		}

		/*	or an interface...	*/
		elseif ( interface_exists($class, FALSE) ) 
		{
			/*	nothing to do here	*/
		}
		/*	or a trait if you're not on 5.3 anymore...	*/
		elseif ( trait_exists($class, FALSE) ) 
		{
			/*	nothing to do here	*/
		}
		/*	else something went wrong somewhere, barf and exit now	*/
		elseif ( $file )
		{
			//throw new RuntimeException('File \'' . Boone::removePath($file) . '\' does not contain class \'' . $class . '\'');
		} 
		else 
		{
			//throw new RuntimeException('Class \'' . $class . '\' is not defined');
		}
	}
}