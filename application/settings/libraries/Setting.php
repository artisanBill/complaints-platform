<?php

class Setting
{
	/**
	 * Settings cache
	 *
	 * @var	array
	 */
	private static $cache = [];

	/**
	 * The settings table columns
	 *
	 * @var	array
	 */
	private static $columns = ['slug', 'name', 'descriptor', 'type', 'default', 'value', 'options', 'isRequired', 'isGui', 'module', 'order'];

	/**
	 * The Settings Construct
	 */
	public function __construct()
	{
		get_instance()->load->model('settings/setting_model');

		//get_instance()->lang->load('setting');

		static::getAll();
	}

	/**
	 * Getter
	 *
	 * Gets the setting value requested
	 *
	 * @param	string	$name
	 */
	public function __get($name)
	{
		return static::get($name);
	}

	/**
	 * Setter
	 *
	 * Sets the setting value requested
	 *
	 * @param	string	$name
	 * @param	string	$value
	 * @return	bool
	 */
	public function __set($name, $value)
	{
		return static::set($name, $value);
	}

	/**
	 * Get
	 *
	 * Gets a setting.
	 *
	 * @param	string	$name
	 * @return	bool
	 */
	public static function get($name)
	{
		if (isset(static::$cache[$name]))
		{
			return static::$cache[$name];
		}

		$setting = get_instance()->setting_model->getBy(['slug' => $name]);

		// Setting doesn't exist, maybe it's a config option
		$value = $setting ? $setting->value : config_item($name);

		// Store it for later
		static::$cache[$name] = $value;

		return $value;
	}

	/**
	 * Set
	 *
	 * Sets a config item
	 *
	 * @param	string	$name
	 * @param	string	$value
	 * @return	bool
	 */
	public static function set($name, $value)
	{
		if (is_string($name))
		{
			if (is_scalar($value))
			{
				$setting = get_instance()->setting_model->update($name, array('value' => $value));
			}

			static::$cache[$name] = $value;

			return true;
		}

		return FALSE;
	}

	/**
	 * Temp
	 *
	 * Changes a setting for this request only. Does not modify the database
	 *
	 * @param	string	$name
	 * @param	string	$value
	 * @return	bool
	 */
	public static function temp($name, $value)
	{
		// store the temp value in the cache so that all subsequent calls
		// for this request will use it instead of the database value
		static::$cache[$name] = $value;
	}

	/**
	 * All
	 *
	 * Gets all the settings
	 *
	 * @return	array
	 */
	public static function getAll(array $data = [])
	{
		if (static::$cache)
		{
			return static::$cache;
		}

		$settings = get_instance()->setting_model->getManyBy($data);

		foreach ($settings as $setting)
		{
			static::$cache[$setting->slug] = $setting->value;
		}

		return static::$cache;
	}

	/**
	 * Add Setting
	 *
	 * Adds a new setting to the database
	 *
	 * @param	array	$setting
	 * @return	int
	 */
	public static function add($setting)
	{
		if ( ! static::checkFormat($setting))
		{
			return FALSE;
		}
		return get_instance()->setting_model->insert($setting);
	}

	/**
	 * Delete Setting
	 *
	 * Deletes setting to the database
	 *
	 * @param	string	$name
	 * @return	bool
	 */
	public static function delete($name)
	{
		return get_instance()->setting_model->delete_by(array('slug' => $name));
	}

	/**
	 * Form Control
	 *
	 * Returns the form control for the setting.
	 *
	 * @todo: Code duplication, see modules/themes/controllers/admin.php @ formControl().
	 *
	 * @param	object	$setting
	 * @return	string
	 */
	public function formControl( & $setting)
	{
		if ($setting->options)
		{
			// @usage func:function_name | func:helper/function_name | func:module/helper/function_name
			// @todo: document the usage of prefix "func:" to get dynamic options
			// @todo: document how construct functions to get here the expected data
			if (substr($setting->options, 0, 5) == 'func:')
			{
				$func = substr($setting->options, 5);

				if (($pos = strrpos($func, '/')) !== FALSE)
				{
					$helper	= substr($func, 0, $pos);
					$func	= substr($func, $pos + 1);

					if ($helper)
					{
						get_instance()->load->helper($helper);
					}
				}

				if (is_callable($func))
				{
					// @todo: add support to use values scalar, bool and null correctly typed as params
					$setting->options = call_user_func($func);
				}
				else
				{
					$setting->options = ['=' . lang('global.select-none')];
				}
			}

			// If its an array un-CSV it
			if (is_string($setting->options))
			{
				$setting->options = explode('|', $setting->options);
			}
		}
		switch ($setting->type)
		{
			default:
			case 'text':
				$formControl = form_input([
					'id'	=> $setting->slug,
					'name'	=> $setting->slug,
					'value'	=> $setting->value,
					'class'	=> 'form-control'
				]);
				break;

			case 'textarea':
				$formControl = form_textarea([
					'id'	=> $setting->slug,
					'name'	=> $setting->slug,
					'value'	=> $setting->value,
					'class'	=> 'form-control',
					'data-provides'	=> 'wysiwyg',
					'data-height'	=> '340',
					'data-folders'	=> '',
					'data-disk'	=> 'en',
					'data-locale'	=> '',
					'data-buttons'	=> 'html,formatting,bold,italic,deleted,unorderedlist,orderedlist,outdent,indent,link,alignment,horizontalrule,underline',
					'data-plugins'	=> 'table,video,fontsize,filemanager,imagemanager,fullscreen',
					'dir'	=>'ltr'
				]);
				break;

			case 'password':
				$formControl = form_password([
					'id'	=> $setting->slug,
					'name'	=> $setting->slug,
					'value'	=> 'XXXXXXXXXXXX',
					'class'	=> 'form-control',
					'autocomplete' => 'off',
				]);
				break;

			case 'select':
				$formControl = form_dropdown($setting->slug, static::formatOptions($setting->options), $setting->value, [
					'class'				=> 'c-select form-control',
					'data-live-search'	=>"true",
					'data-style'		=>"btn-white",
				]);
				break;

			case 'select-multiple':
				$options = static::formatOptions($setting->options);
				$size = sizeof($options) > 10 ? ' size="10"' : '';
				$formControl = form_multiselect($setting->slug . '[]', $options, explode(',', $setting->value), 'class="jquery-tagIt-default"' . $size);
				break;

			case 'checkbox':

				$formControl = '';
				$storedValues = is_string($setting->value) ? explode(',', $setting->value) : $setting->value;

				foreach (static::formatOptions($setting->options) as $value => $label)
				{
					if (is_array($storedValues))
					{
						$checked = in_array($value, $storedValues);
					}
					else
					{
						$checked = FALSE;
					}

					$formControl .= '<label class="checkbox">';
					$formControl .= '' . form_checkbox([
						'id'		=> $setting->slug . '_' . $value,
						'name'		=> $setting->slug . '[]',
						'checked'	=> $checked,
						'value'		=> $value
					]);
					$formControl .= '<i></i>' . $label . '</label>&nbsp;&nbsp;';
				}
				break;

			case 'radio':

				$formControl = '';
				foreach (static::formatOptions($setting->options) as $value => $label)
				{
					$formControl .= '<label class="c-input c-radio">' . form_radio([
						'id'		=> $setting->slug,
						'name'		=> $setting->slug,
						'checked'	=> $setting->value == $value,
						'value'		=> $value
					]) . '<span class="c-indicator"></span>' . $label . '</label>';
				}
				break;
		}

		return $formControl;
	}

	/**
	 * Format Options
	 *
	 * Formats the options for a setting into an associative array.
	 *
	 * @param	array	$options
	 * @return	array
	 */
	private static function formatOptions($options = [])
	{
		$select_array = [];
		foreach ( $options as $option)
		{
			list($value, $name) = explode('=', $option);

			if (get_instance()->lang->line('option.form_option_' . $name) !== FALSE)
			{
				$name = get_instance()->lang->line('option.form_option_' . $name);
			}

			$select_array[$value] = $name;
		}

		return $select_array;
	}

	/**
	 * Check Format
	 *
	 * This assures that the setting is in the correct format.
	 * Works with arrays or objects (it is PHP 5.3 safe)
	 *
	 * @param	string		$setting
	 * @return	boolean		If the setting is the correct format
	 */
	private static function checkFormat($setting)
	{
		if ( ! isset($setting))
		{
			return FALSE;
		}
		foreach ($setting as $key => $value)
		{
			if ( ! in_array($key, static::$columns))
			{
				return FALSE;
			}
		}

		return true;
	}
}