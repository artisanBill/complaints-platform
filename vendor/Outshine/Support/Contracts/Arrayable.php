<?php namespace Boone\Outshine\Support\Contracts;

/**
 *	Class Arrayable
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		Boone\Outshine\Support\Contracts\Arrayable
 */
interface Arrayable
{
	/**
	 *	Get the instance as an array.
	 *
	 *	@return		array
	 */
	public function toArray() : array;
}