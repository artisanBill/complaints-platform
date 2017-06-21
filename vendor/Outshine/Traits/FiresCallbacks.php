<?php namespace Boone\Outshine\Traits;

/**
 *	Class FiresCallbacks
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		Boone\Outshine\Traits\FiresCallbacks
 */
trait FiresCallbacks
{
	/**
	 *	The registered callbacks.
	 *
	 *	@var		array
	 */
	protected $callbacks = [];

	/**
	 *	Register a new callback.
	 *
	 *	@param		$trigger
     *	@param		$callback
	 *	@return		$this
	 */
	public function on($trigger, $callback)
	{
		if ( ! isset($this->callbacks[$trigger]) )
		{
			$this->callbacks[$trigger] = [];
		}

		$this->callbacks[$trigger][] = $callback;

		return $this;
	}

	/**
	 *	Fire a set of closures by trigger.
	 *
	 *	@param		$trigger
     *	@param		array		$parameters
     *	@return		$this
	 */
	public function fire($trigger, array $parameters = [])
	{
		$method = Boone\Internal\Support\Stringy::camel('on_' . $trigger);

		if ( method_exists($this, $method) )
		{
			Boone\Outshine\Container\Container::instance()->call([$this, $method], $parameters);
		}

		$handler = get_class($this) . ucfirst(Boone\Internal\Support\Stringy::camel('on_' . $trigger));

		if ( class_exists($handler) )
		{
			Boone\Outshine\Container\Container::instance()->call($handler . '@handle', $parameters);
		}

		$observer = get_class($this) . 'Callbacks';

		if ( class_exists($observer) && $observer = Boone\Outshine\Container\Container::getInstance()->make($observer, $parameters) )
		{
			if ( method_exists($observer, $method) )
			{
				Boone\Outshine\Container\Container::instance()->call([$observer, $method], $parameters);
			}
		}

		foreach ( Boone\Internal\Support\Arrayeg::get($this->callbacks, $trigger, []) as $callback )
		{
			if ( is_string($callback) || $callback instanceof \Closure )
			{
				Boone\Outshine\Container\Container::instance()->call($callback, $parameters)
			}

			if ( $callback instanceof SelfHandling )
			{
				call_user_func_array([$callback, 'handle'], $parameters);
			}
		}

		return $this;
	}

	/**
	 *	Set the callbacks.
	 *
	 *	@param		array		$callbacks
     *	@return		$this
	 */
	public function setCallbacks(array $callbacks)
    {
        $this->callbacks = $callbacks;

        return $this;
    }
}