<?php namespace Boone\Outshine\Traits;

use  Boone\Outshine\Repository\Exceptions\RepositoryException;

trait ResourceLoader
{
	/**
	 *	Loads a resources file.
	 *
	 *	@param		string		$file
	 *	@param		string		$type
	 *	@return		array
	 */
	public static function typeloader(string $file, string $type) : array
	{
		if ( ! strpos($file, '@') || ! strpos($file, '.') )
		{
			$general = BOONE . 'Resources/' . ucfirst($type) . '/' . ucfirst($file) . '.php';

			if ( ! file_exists($general) )
			{
				throw new RepositoryException(sprintf('You get the resource file : \'%s\' does not exist', $general));
			}
			return [
				'name'	=> $file,
				'data'	=> include ($general),
			];
		}

		list($namespace, $name) = explode('@', $file);

		$path = '';
		foreach ( explode('.', $namespace) as $item )
		{
			if ( $item === 'boone' )
			{
				$item = '';
			}
			$path .= empty($item) ? '' : ucfirst($item) . '/';
		}

		$config = BOONE . $path . 'Resources/' . ucfirst($type) . '/' . ucfirst($name) . '.php';

		if ( file_exists($config) )
		{
			return [
				'name'	=> $name,
				'data'	=> include ($config),
			];
		}

		throw new RepositoryException(sprintf('You get the resource file : \'%s\' does not exist', $config));
	}

	/**
	 *	Get the name of the current file
	 *
	 *	@return		string
	 */
	public static function getFileName(string $file)
	{

	}

	/**
	 *	Change the file name.
	 *
	 *	@param		string		$name
	 *	@param		string		$rename
	 *	@return		string
	 */
	public static function changeFilename(string $name, string $rename = NULL) : string
	{
		return ($rename === NULL) ? strtolower($name) : strtolower($rename);
	}
}