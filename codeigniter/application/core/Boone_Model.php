<?php defined('BOONE') OR exit('No direct script access allowed.');

/**
 *  Class Boone_Model
 *
 *  @link           http://cms.boone.ren
 *  @author         Boone <ililianjin@iCloud.com>
 *  @author         Outshine Development Team <outshine@boone.red>
 *  @version        1.0.0
 *  @package        BooneCPS
 */
class Boone_Model extends CI_Model
{
	/**
     * The database table to use, only set if you want to bypass the magic.
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key, by default set to `id`, for use in some functions.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * An array of functions to be called before a record is created.
     *
     * @var array
     */
    protected $beforeCreate = [];

    /**
     * An array of functions to be called after a record is created.
     *
     * @var array
     */
    protected $afterCreate = [];

    /**
     * An array of validation rules
     *
     * @var array
     */
    protected $validate = [];

    /**
     * Skip the validation
     *
     * @var bool
     */
    protected $skipValidation = false;


    /**
     * The class constructor, tries to guess the table name.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('inflector');
        $this->fetchTable();
    }

    /**
     *
     * @param string $method
     * @param array $arguments
     * @return \MY_Model
     * @throws Exception
     */
    public function __call($method, $arguments)
    {
        $db_method = array($this->db, $method);

        if (is_callable($db_method))
        {
            $result = call_user_func_array($db_method, $arguments);

            if (is_object($result) && $result === $this->db)
            {
                return $this;
            }

            return $result;
        }

        throw new Exception("class '".get_class($this)."' does not have a method '".$method."'");
    }

    /**
     * Whether there is a field checklist
     *
     * @param  string $name
     * @param  string $condition
     * @return bool
     */
    public function checkSlugExists(string $name, string $condition)
    {
        $sql = $this->db->query(sprintf('SELECT %s FROM %s WHERE %s=\'%s\' ', $name, $this->tableName(), $name, $condition));
        return $sql->num_rows() ? FALSE : TRUE;
    }

    /**
     * Get table name
     *
     * @param boolean $prefix Whether the table name should be prefixed or not.
     * @return string
     */
    public function tableName($prefix = TRUE)
    {
        return $prefix ? $this->db->dbprefix($this->table) : $this->table;
    }

    /**
     * Set table name
     *
     * @param string $name The name for the table.
     * @return string
     */
    public function setTableName($name = null)
    {
        return $this->table = $name;
    }

    /**
     * Get a single record by creating a WHERE clause with a value for your
     * primary key.
     *
     * @param string $id The value of your primary key
     * @return object
     */
    public function get($id)
    {
        return $this->db->where($this->primaryKey, $id)
                        ->get($this->table)
                        ->row();
    }

    /**
     * Get a single record by creating a WHERE clause with the key of $key and
     * the value of $val.
     *
     * @todo What are the ghost parameters this accepts?
     *
     * @return object
     */
    public function getBy($key = null, $value = null)
    {
        $where = func_get_args();
        $this->setWhere($where);

        return $this->db->get($this->table)
                        ->row();
    }

    /**
     * Get many result objects in an array.
     *
     * Similar to get(), but returns a result array of many result objects.
     *
     * @param string $primary_value The value of your primary key
     * @return array
     */
    public function getMany($primary_value)
    {
        $this->db->where($this->primaryKey, $primary_value);
        return $this->getAll();
    }

    /**
     * Similar to get_by(), but returns a result array of many result objects.
     *
     * The function accepts ghost parameters, fetched via func_get_args().
     * Those are:
     *  1. string `$key` The key to search by.
     *  2. string `$value` The value of that key.
     *
     * They are used in the query in the where statement something like:
     *   <code>[...] WHERE {$key}={$value} [...]</code>
     *
     * @return array
     */
    public function getManyBy()
    {
        $where = func_get_args();
        $this->setWhere($where);

        return $this->getAll();
    }

    /**
     * Get all records in the database
     *
     * @return object
     */
    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    /**
     * Similar to get_by(), but returns a result array of many result objects.
     *
     * The function accepts ghost parameters, fetched via func_get_args().
     * Those are:
     *  1. string `$key` The key to search by.
     *  2. string `$value` The value of that key.
     *
     * They are used in the query in the where statement something like:
     *   <code>[...] WHERE {$key}={$value} [...]</code>
     *
     * @return array
     */
    public function countBy()
    {
        $where = func_get_args();
        $this->setWhere($where);

        return $this->db->count_all_results($this->table);
    }

    /**
     * Get all records in the database
     *
     * @return array
     */
    public function countAll()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Insert a new record into the database, calling the before and after
     * create callbacks.
     *
     * @param array $data Information
     * @param boolean $skipValidation Whether we should skip the validation of the data.
     * @return integer|true The insert ID
     */
    public function insert($data, $skipValidation = false)
    {
        if ($skipValidation === false)
        {
            if ( ! $this->runValidation($data))
            {
                return false;
            }
        }

        $data = $this->runBeforeCreate($data);
        $this->db->insert($this->table, $data);
        $this->runAfterCreate($data, $this->db->insert_id());

        $this->skipValidation = false;

        return $this->db->insert_id();
    }

    /**
     * Insert multiple rows at once.
     *
     * Similar to insert(), just passing an array to insert multiple rows at
     * once.
     *
     * @param array $data Array of arrays to insert
     * @param boolean $skipValidation Whether we should skip the validation of the data.
     * @return array An array of insert IDs.
     */
    public function insertMany($data, $skipValidation = false)
    {
        $ids = [];

        foreach ($data as $row)
        {
            if ($skipValidation === false)
            {
                if ( ! $this->runValidation($row))
                {
                    $ids[] = false;

                    continue;
                }
            }

            $data = $this->runBeforeCreate($row);
            $this->db->insert($this->table, $row);
            $this->runAfterCreate($row, $this->db->insert_id());

            $ids[] = $this->db->insert_id();
        }

        $this->skipValidation = false;
        return $ids;
    }

    /**
     * Update a record, specified by an ID.
     *
     * @param integer $primary_value The primary key basically the row's ID.
     * @param array $data The data to update.
     * @param boolean $skipValidation Whether we should skip the validation of the data.
     * @return boolean
     */
    public function update($primary_value, $data, $skipValidation = false)
    {
        if ($skipValidation === false)
        {
            if ( ! $this->runValidation($data))
            {
                return false;
            }
        }

        $this->skipValidation = false;

        return $this->db->where($this->primaryKey, $primary_value)
                        ->set($data)
                        ->update($this->table);
    }

    /**
     * Update a record, specified by $key and $val.
     *
     * The function accepts ghost parameters, fetched via func_get_args().
     * Those are:
     *  1. string `$key` The key to update with.
     *  2. string `$value` The value to match.
     *  3. array  `$data` The data to update with.
     * The first two are used in the query in the where statement something like:
     *   <code>UPDATE {table} SET {$key}={$data} WHERE {$key}={$value}</code>
     *
     * @return boolean
     */
    public function updateBy()
    {
        $args = func_get_args();
        $data = array_pop($args);
        $this->setWhere($args);

        if (!$this->runValidation($data))
        {
            return false;
        }

        $this->skipValidation = false;

        return $this->db->set($data)
                        ->update($this->table);
    }

    /**
     * Updates many records, specified by an array of IDs.
     *
     * @param array $primaryValues The array of IDs
     * @param array $data The data to update
     * @param boolean $skipValidation Whether we should skip the validation of the data.
     * @return boolean
     */
    public function updateMany($primaryValues, $data, $skipValidation = false)
    {
        if ($skipValidation === false)
        {
            if ( ! $this->runValidation($data))
            {
                return false;
            }
        }

        $this->skipValidation = false;

        return $this->db->where_in($this->primaryKey, $primaryValues)
                        ->set($data)
                        ->update($this->table);
    }

    /**
     * Updates all records
     *
     * @param array $data The data to update
     * @return bool
     */
    public function updateAll($data)
    {
        return $this->db
                    ->set($data)
                    ->update($this->table);
    }

    /**
     * Delete a row from the database table by ID.
     *
     * @param integer $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->db->where($this->primaryKey, $id)
                        ->delete($this->table);
    }

    /**
     * Delete a row from the database table by the key and value.
     *
     * @return bool
     */
    public function deleteBy()
    {
        $where = func_get_args();
        $this->setWhere($where);

        return $this->db->delete($this->table);
    }

    /**
     * Delete many rows from the database table by an array of IDs passed.
     *
     * @param array $primaryValues
     * @return bool
     */
    public function deleteMany($primaryValues)
    {
        return $this->db->where_in($this->primaryKey, $primaryValues)
                        ->delete($this->table);
    }

    /**
     * Generate the dropdown options.
     *
     * @return array The options for the dropdown.
     */
    function dropdown()
    {
        $args = func_get_args();

        if (count($args) == 2)
        {
            list($key, $value) = $args;
        }
        else
        {
            $key = $this->primaryKey;
            $value = $args[0];
        }

        $query = $this->db->select(array($key, $value))
                ->get($this->table);

        $options = [];
        foreach ($query->result() as $row)
        {
            $options[$row->{$key}] = $row->{$value};
        }

        return $options;
    }

    /**
     * Orders the result set by the criteria, using the same format as CodeIgniter's AR library.
     *
     * @param string $criteria The criteria to order by
     * @param string $order the order direction
     * @return \MY_Model
     */
    public function orderBy($criteria, $order = 'ASC')
    {
        $this->db->order_by($criteria, $order);
        return $this;
    }

    /**
     * Limits the result set.
     *
     * Pass an integer to set the actual result limit. Pass a second integer set the offset.
     *
     * @param int $limit The number of rows
     * @param int $offset The offset
     * @return \MY_Model
     */
    public function limit($limit, $offset = 0)
    {
        $limit = func_get_args();
        $this->setLimit($limit);
        return $this;
    }

    /**
     * Removes duplicate entries from the result set.
     *
     * @return \MY_Model
     */
    public function distinct()
    {
        $this->db->distinct();
        return $this;
    }

    /**
     * Run validation only using the
     * same rules as insert/update will
     *
     * @param array $data
     *
     * @return bool
     */
    public function validate($data)
    {
        return $this->runValidation($data);
    }

    /**
     * Return only the keys from the validation array
     *
     * @return array
     */
    public function fields()
    {
        $keys = [];

        if ($this->validate)
        {
            foreach ($this->validate as $key)
            {
                $keys[] = $key['field'];
            }
        }

        return $keys;
    }

    /**
     * Runs the before create actions.
     *
     * @param array $data The array of actions
     * @return mixed
     */
    private function runBeforeCreate($data)
    {
        foreach ($this->beforeCreate as $method)
        {
            $data = call_user_func_array(array($this, $method), [$data]);
        }

        return $data;
    }

    /**
     * Runs the after create actions.
     *
     * @param array $data The array of actions
     * @param int $id
     */
    private function runAfterCreate($data, $id)
    {
        foreach ($this->afterCreate as $method)
        {
            call_user_func_array(array($this, $method), array($data, $id));
        }
    }

    /**
     * Runs validation on the passed data.
     *
     * @param array $data
     * @return boolean
     */
    private function runValidation($data)
    {
        if ($this->skipValidation)
        {
            return true;
        }

        if (empty($this->validate))
        {
            return true;
        }

        $this->load->library('form_validation');

        // only set the model if it can be used for callbacks
        if ($class = get_class($this) and $class !== 'Boone_Model')
        {
            // make sure their MY_Form_validation is set up for it
            if (method_exists($this->form_validation, 'set_model'))
            {
                $this->form_validation->set_model($class);
            }
        }

        $this->form_validation->set_data($data);

        if (is_array($this->validate))
        {
            $this->form_validation->set_rules($this->validate);
            return $this->form_validation->run();
        }

        return $this->form_validation->run($this->validate);
    }

    /**
     * Fetches the table from the pluralised model name.
     *
     */
    private function fetchTable()
    {
        if ($this->table == null)
        {
            $class = preg_replace('/(Model|_M)?$/', '', get_class($this));
            $this->table = plural(strtolower($class));
        }
    }

    /**
     * Sets where depending on the number of parameters
     *
     * @param array $params
     */
    private function setWhere($params)
    {
        if (count($params) == 1)
        {
            $this->db->where($params[0]);
        }
        else
        {
            $this->db->where($params[0], $params[1]);
        }
    }

    /**
     * Sets limit depending on the number of parameters
     *
     * @param array $params
     */
    private function setLimit($params)
    {
        if (count($params) == 1)
        {
            if (is_array($params[0]))
            {
                $this->db->limit($params[0][0], $params[0][1]);
            }
            else
            {
                $this->db->limit($params[0]);
            }
        }
        else
        {
            $this->db->limit((int) $params[0], (int) $params[1]);
        }
    }

    /**
     *  Generate a "random" alpha-numeric string.
     *
     *  Should not be considered sufficient for cryptography, etc.
     *
     *  @param      int     $length
     *  @return     string
     */
    public static function quickRandom(int $length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}