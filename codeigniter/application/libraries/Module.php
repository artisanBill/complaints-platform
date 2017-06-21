<?php
/**
 *	Class Module
 *
 *	@link			http://cms.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		BooneCPS
 */
abstract class Module
{
	/**
	 * The version of the module.
	 *
	 * @var string
	 */
	public $version;

	/**
	 * The information about the module
	 *
	 * @var array
	 */
	public $infomartion =  [];

	/**
	 * Installs a module's tables and database tables and data.
	 *
	 * Called upon first install of the module. The typical case is that the module's tables are initially dropped from 
	 * the database and subsequently are created again. But this is up to the module to implement.
	 *
	 * @return	bool	Whether the module was installed
	 */
	public abstract function install();

	/**
	 * Called upon the uninstall of the module.
	 *
	 * @return	bool	Whether the module was uninstalled
	 */
	public abstract function uninstall();

	/**
	 * Called when this is a newer version than currently installed.
	 *
	 * @param string $old_version The version to upgrade from
	 * @return bool Whether the module was installed
	 */
	public abstract function upgrade($old_version);

	/**
	 * Loads the database and dbforge libraries.
	 */
	public function __construct()
	{
		$this->load->database();
		$this->load->dbforge();
	}

	/**
	 * Returns the help text for a module.
	 *
	 * By default returns "No Help Provided".
	 *
	 * @return string
	 */
	public function help()
	{
		return lang('modules.noHelp');
	}

	/**
	 * Allows this class and classes that extend this to use $this-> just like you were in a controller.
	 *
	 * @return mixed
	 */
	public function __get($var)
	{
		static $ci;
		isset($ci) OR $ci = get_instance();
		return $ci->{$var};
	}

	/**
	 * Installs the modules tables in the database.
	 *
	 * Can handle primary keys and FULLTEXT indexes.
	 *
	 * @param array $tables The database tables definitions.
	 */
	public function installTables($tables)
	{
		log_message('error', 'Will go ahead and create the following tables: ' . implode(', ', array_keys($tables)));
		foreach ($tables as $tableName => $fields)
		{
			log_message('error', '-- Creating table: '.$tableName);
			// First we go ahead and add all the fields.
			$this->dbforge->add_field($fields);

			// Then go ahead and check for our special cases such as, primary and fulltext keys.
			$keyTypes = [
				'primary' => [],
				'fulltext' => [],
				'unique' => [],
				'key' => [],
			];

			// For all the fields of this table definition:
			foreach ($fields as $field => $field_data)
			{
				// For each of the key types we know
				foreach (array_keys($keyTypes) as $type)
				{
					// Check with every property of the field definition...
					foreach ($field_data as $key => $value)
					{
						// to find if any of the one-above key types.
						if ($key === $type)
						{
							$this->addToArray($keyTypes[$type], $value, $field, $type);
						}

						// This is purely for convenience here since 'index' is
						// a synonym to 'key'.
						if ($key == 'index')
						{
							$this->addToArray($keyTypes['key'], $value, $field, 'key');
						}
					}
				}
			}

			// Add primary keys
			$this->addKeys('primary', $keyTypes['primary']);

			// Add normal keys
			$this->addKeys('key', $keyTypes['key']);

			// Then we create the table (if not exists).
			if ( ! $this->dbforge->create_table($tableName, TRUE))
			{
				log_message('error', '-- Table creation for '.$tableName.' failed.');
				return FALSE;
			}

			// Then we create the fulltext keys.
			if ( ! $this->createKeys('fulltext', $keyTypes['fulltext'], $tableName))
			{
				log_message('error', '-- Fulltext key creation failed for '.$tableName);
				return FALSE;
			}

			// Then we create the rest of the keys.
			if ( ! $this->createKeys('unique', $keyTypes['unique'], $tableName))
			{
				log_message('error', '-- Unique key creation failed for '.$tableName);
				return FALSE;
			}
		}
		log_message('error', 'All done perfectly!');
		return TRUE;
	}

	/**
	 * Adds keys to the table creation SQL.
	 *
	 * A key type has to be specified to in this because of the differentiated handling on adding multiple primary keys 
	 * by Codeigniter's DBForge to the normal keys.
	 *
	 * @param string $type	The type of key to add.
	 * @param array $keys	Key-value pairs for the key's info.
	 */
	protected function addKeys($type, $keys)
	{
		if (count($keys) > 0)
		{
			if (count($keys) > 1)
			{
				// Primary keys are special cases.
				if ($type == 'primary')
				{
					// Add them one by one.
					foreach ($keys as $i => $primary_key)
					{
						$this->dbforge->add_key($keys[$i], TRUE);
					}
				}
				// Everything else can be just be supplied as an array.
				else
				{
					$this->dbforge->add_key($keys);
				}
			}
			else
			{
				$array_keys = array_keys($keys);
				$this->dbforge->add_key($keys[array_shift($array_keys)], ($type == 'primary'));
			}
		}
	}

	/**
	 * Executes the SQL to create table keys after table creation.
	 *
	 * @param string $type The type of the key to create.
	 * @param array $keys  Key-value pairs for the key info.
	 * @param string $table The name of the table on which to create the keys
	 * @return boolean True if successful, FALSE otherwise.
	 */
	protected function createKeys($type, $keys, $table)
	{
		// Sorry, we only support specific keys for now
		if ( ! in_array($type, ['fulltext', 'unique']))
		{
			return FALSE;
		}

		// Make sure the type is uppercase
		$type = strtoupper($type);

		if (count($keys) > 0)
		{
			// @todo there is no checking whether the index exists already.

			// FULLTEXT is only available on MyISAM.
			if($type === 'FULLTEXT') {
				$sql = 'ALTER TABLE ' . $this->db->dbprefix($table) . ' ENGINE = MyISAM';
				if ( ! $this->db->query($sql) )
				{
					log_message('error', '-- -- Failed turning the engine for ' . $table . ' to MyISAM. SQL: '.$sql);
					return FALSE;
				}
			}
			foreach ($keys as $key => $fields)
			{
				$sql = 'CREATE '.$type.' INDEX '.$key.' ON '.$this->db->dbprefix($table) . '('.implode(', ', $fields) . ')';
				if ( ! $this->db->query($sql))
				{
					log_message('error', '-- -- Failed creating key ' . $type . ' for ' . $table . ': ' . $sql);
					return FALSE;
				}
			}
		}

		return TRUE;
	}

	/**
	 * Adds a field to the key type array storage.
	 *
	 * We gather all the keys in an array so that we can handle them later on.
	 *
	 * @param array $arr The array that holds the specific key type keys.
	 * @param string $index A name for the key. If none is specified then we let the DBForge do it's thing.
	 * @param string $value The name of the field to attach to the key we are adding.
	 * @param string $type The key's type.
	 */
	protected function addToArray(&$arr, $index, $value, $type='')
	{
		if(is_array($value))
		{
			foreach ($value as $v)
			{
				$this->addToArray($arr, $index, $v, $type);
			}
		}

		if ( is_bool($index) and $index === TRUE)
		{
			// The key/index takes the fields name.
			$index = ( ! empty($type)) ? $type . '_' . $value : $value;
		}

		// If we dont have a key for this
		if (!array_key_exists($index, $arr))
		{
			// Go ahead and create it
			$arr[$index] = [];
		}
		// Add it
		$arr[$index][] = $value;
	}
}