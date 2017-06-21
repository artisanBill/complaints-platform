<?php

/**
 *	Class Blog_model.php
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */
class Blog_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'blog';

	/**
	 * Create a post.
	 *
	 * @param  int|integer $categoriesId
	 * @param  array	   $post
	 * @return bool
	 */
	public function create(int $categoriesId = 0, array $post) : bool
	{
		$this->db->trans_begin();
		//$publishAt = $post['postPublishAt'];
		$basic = [
			'categories'	=> $categoriesId,
			'userId'		=> $this->currentUser->id,
			'metaTitle'		=> $post['metaTitle'],
			'slug'			=> date('YmdHis') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8),
			'tags'			=> serialize($post['tags']),
			'summary'		=> $post['summary'],
			'image'			=> isset($post['image']) ? $post['image'] : NULL,
			'images'		=> isset($post['images']) ? $post['images'] : NULL,
			'featured'		=> isset($post['featured']) ? 1 : 0,
			'status'		=> isset($post['status']) ? 1 : 0,
			//'publishAt'		=> $publishAt['date'] . $publishAt['time'],
			'createOn'		=> time(),
		];

		//	Execute create post basic.
		$this->insert($basic);

		//	Get last inserted post id
		$bodyId = $this->db->insert_id();

		$bodyData = [
			'postId'			=> $bodyId,
			'content'			=> htmlspecialchars($post['content']),
			'enableComment'		=> isset($post['enableComment']) ? 1 : 0
		];

		//	Insert post body content
		$this->db->insert('blog_body', $bodyData);

		//	Create tags
		$tags = $post['tags'];
		if ( strpos($tags, ',') )
		{
			$dataInsert = explode(',', $tags);
		}
		else
		{
			$dataInsert  = [$tags];
		}

		foreach ( $dataInsert as &$item )
		{
			$tagData = [
				'postId'	=> $bodyId,
				'item'		=> $item,
			];
			$this->db->insert('blog_tags', $tagData);
		}

		if ( $this->db->trans_status() === FALSE )
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		else
		{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	/**
	 * Implementation of article updates.
	 *
	 * @param  int|integer $categoriesId [description]
	 * @param  array       $post         [description]
	 * @param  int         $blogId       [description]
	 * @return [type]                    [description]
	 */
	public function updateExecute(int $categoriesId = 0, array $post, int $blogId) : bool
	{
		$this->db->trans_begin();

		$basic = [
			'categories'	=> $categoriesId,
			'userId'		=> $this->currentUser->id,
			'metaTitle'		=> $post['metaTitle'],
			'slug'			=> date('YmdHis') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8),
			'tags'			=> serialize($post['tags']),
			'summary'		=> $post['summary'],
			'image'			=> isset($post['image']) ? $post['image'] : NULL,
			'images'		=> isset($post['images']) ? $post['images'] : NULL,
			'featured'		=> isset($post['featured']) ? 1 : 0,
			'status'		=> isset($post['status']) ? 1 : 0,
			//'publishAt'		=> $publishAt['date'] . $publishAt['time'],
		];

		$this->update($blogId, $basic);

		$bodyData = [
			'content'			=> htmlspecialchars($post['content']),
			'enableComment'		=> isset($post['enableComment']) ? 1 : 0,
			'updateOn'			=> time()
		];

		$this->db->where('postId', $blogId)->set($bodyData)->update($this->db->dbprefix('blog_body'));

		$updateTags = $this->db->where('postId', $blogId)->get($this->db->dbprefix('blog_tags'))->result();

		foreach ( $updateTags as $tag )
		{
			$this->db->where('id', $tag->id)
			 ->delete($this->db->dbprefix('blog_tags'));
		}

		//	Create tags
		$tags = $post['tags'];
		if ( strpos($tags, ',') )
		{
			$dataInsert = explode(',', $tags);
		}
		else
		{
			$dataInsert  = [$tags];
		}

		foreach ( $dataInsert as &$item )
		{
			$tagData = [
				'postId'	=> $blogId,
				'item'		=> $item,
			];
			$this->db->insert('blog_tags', $tagData);
		}

		if ( $this->db->trans_status() === FALSE )
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		else
		{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	/**
	 * List blog.
	 *
	 * @param  int|integer $categoriesId
	 * @return array
	 */
	public function list(int $categoriesId = 0, $isCurrentUser = TRUE)
	{
		$baseWhere = $this->filterData('data');

		$userKeyword = '';

		if ( isset($baseWhere['userkeyword']) )
		{
			$userKeyword = $baseWhere['userkeyword'];
			unset($baseWhere['userkeyword']);
		}

		// Create pagination links
		$pagination = createPagination('blog/' . $categoriesId, $this->countBy($baseWhere, $userKeyword));

		$this->db->select([
				'blog.*',
				'blog_categories.name as categorieName',
				'member.avatar as userAvatar',
				'member_profile.displayName as userDisplayName',
				'blog_settings.blogName as userBlogName',
				'blog_settings.concern as blogConcern',
				'blog_settings.blogCount',
				'blog_settings.domain as blogDomain',
			])
			->order_by('createOn', 'desc')
			->join('member', 'member.id = blog.userId')
			->join('member_profile', 'member_profile.userId = member.id')
			->join('blog_categories', 'blog_categories.id = blog.categories')
			->join('blog_settings', 'blog_settings.userId = blog.userId')
			->limit($pagination['limit'], $pagination['offset']);

		if ( $isCurrentUser === TRUE)
		{
			$this->db->where('blog.userId', $this->currentUser->id);
		}
		if ( is_numeric($isCurrentUser) )
		{
			$this->db->where('blog.userId', $isCurrentUser);
		}

		if ( $categoriesId )
		{
			$this->db->where_in('blog.categories', $categoriesId);
		}

		$blogData = $this->getManyByAll($baseWhere, $userKeyword);

		return [
			$blogData,
			$pagination
		];
	}

	public function profile($id)
	{
		return $this->db->select([
				'blog.*',
				'blog_categories.name as categorieName',
				'member.avatar as userAvatar',
				'member_profile.displayName as userDisplayName',
				'blog_body.content',
				'blog_body.enableComment',
			])
			->order_by('createOn', 'desc')
			->join('member', 'member.id = blog.userId')
			->join('member_profile', 'member_profile.userId = member.id')
			->join('blog_categories', 'blog_categories.id = blog.categories')
			->join('blog_body', 'blog_body.postId = blog.id')
			->where('blog.slug', $id)
			->get($this->table)
			->row();
	}

	/**
	 * [valdationIdInfo description]
	 * @param  int         $id              [description]
	 * @param  int         $categories      [description]
	 * @param  Boone_Model $categoriesModel [description]
	 * @return [type]                       [description]
	 */
	public function valdationIdInfo(int $id, int $categories, Boone_Model $categoriesModel)
	{
		$blogData = $this->db->select([
			'blog.*',
			'blog_body.id as blogBodyId',
			'blog_body.content',
			'blog_body.enableComment',
		])
		->join('blog_body', 'blog_body.postId = blog.id')
		->where('blog.id', $id)
		->get($this->blog_model->tableName())
		->row();

		$categoriesData = $categoriesModel->get($categories);
		if ( ! $blogData || ! $categoriesData )
		{
			return false;
		}

		return [$blogData, $categoriesData];
	}

	/**
	 * Post list filter query.
	 *
	 * @param  array  $params
	 * @param  string $userKeyword
	 * @return array
	 */
	public function getManyByAll($params = [], $userKeyword = '') : array
	{
		$this->selectByGet($params, $userKeyword);
		return $this->getAll();
	}

	public function countBy($params = [], $userKeyword = '')
	{
		$this->selectByGet($params, $userKeyword);
		return $this->db->count_all_results('blog');
	}

	protected function selectByGet($params = [], $userKeyword = '')
	{
		if ( ! empty($params['categories']))
		{
			$this->db->where_in('blog.categories', $params['categories']);
		}

		/*if ( ! empty($params['status']))
		{
			$this->db->where_in('status', $params['status']);
		}*/

		if ( ! empty($userKeyword))
		{
			$this->db
				->like('blog.metaTitle', trim($userKeyword))
				->or_like('blog.tags', trim($userKeyword))
				->or_like('blog.summary', trim($userKeyword));
		}
	}

	/**
     * Filter form data.
     *
     * @param  array  $key
     * @return array
     */
    private function filterData($key)
    {
        $data = $this->input->get($key);
        $result = [];
        if ( empty($data) )
        {
            return $result;
        }

        foreach ( $data as $k => $val )
        {
            if (isset($k) && ! empty($val) ) 
            {
                $result[$k] = $val;
            }
        }
        return $result;
    }
}