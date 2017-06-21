<?php

class File_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'files';

	/**
	 * Exists
	 *
	 * Checks if a given file exists.
	 * 
	 * @param	int		The file id
	 * @return	bool	If the file exists
	 */
	public function exists($fileId)
	{
		return (bool) (parent::countBy(['id' => $fileId]) > 0);
	}

	/**
     * Get Known Files
     *
     * @param   array | string
     * @return  array
     */
	public function getFiles($id)
	{
		if ( strpos($id, ',') )
		{
			$id = explode(',', $id);
		}
		$this->db->select('files.*, file_folders.name folderName, file_folders.slug folderSlug, file_folders.location folderLocation')
			->join('file_folders', 'file_folders.id = files.folderId')
			->where($this->table . '.id', $id)
			->where_in($this->table . '.userId', $this->currentUser->id);

		return $this->getAll();
	}

	public function getManyByAll($params = [], $keyword = NULL)
	{
		if ( ! empty($params['folderId']))
		{
			$this->db->where_in('files.folderId', $params['folderId']);
		}

		if ( ! empty($keyword) )
		{
			$this->db
				->like('files.filename', trim($keyword))
				->or_like('files.description', trim($keyword))
				->or_like('files.keywords', trim($keyword));
		}
		return $this->getAll();
	}

	public function filterList($requestType = 'get')
	{
		$where = [];
		if ( $this->input->{$requestType}('folderName') )
		{
			$where['folderId'] = $this->input->{$requestType}('folderName');
		}

		$keyword = NULL;

		if ( $this->input->{$requestType}('userKeyword') )
		{
			$keyword = $this->input->{$requestType}('userKeyword');
		}

		// Create pagination links
		$pagination = createPagination('content/file', $this->file_model->countBy($where, $keyword));

		$this->db
			->select('files.*, file_folders.name folderName, file_folders.slug folderSlug, file_folders.location folderLocation')
			->order_by('files.createOn', 'desc')
			->join('file_folders', 'file_folders.id = files.folderId')
			->limit($pagination['limit'], $pagination['offset'])
			->where('files.userId', $this->currentUser->id);

		$fileItems = $this->getManyByAll($where, $keyword);

		return [
			'folders'		=> $this->folders_model->getAll(),
			'fileItems'		=> $fileItems,
			'pagination'	=> $pagination,
			'selected'		=> isset($where['folderId']) ? $where['folderId'] : 0,
		];
	}

}