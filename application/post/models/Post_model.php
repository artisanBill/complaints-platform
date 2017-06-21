<?php

class Post_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	/**
	 * Create a post.
	 *
	 * @param  int|integer $categoriesId
	 * @param  array       $post
	 * @return bool
	 */
	public function create(int $categoriesId = 0, array $post) : bool
	{
		$this->db->trans_begin();
		$publishAt = $post['postPublishAt'];
		$basic = [
			'categories'	=> $categoriesId,
			'userId'		=> $this->currentUser->id,
			'metaTitle'		=> $post['metaTitle'],
			'slug'			=> $post['slug'],
			'summary'		=> $post['summary'],
			'tag'			=> serialize($post['tag']),
			'image'			=> isset($post['images']) ? $post['images'] : NULL,
			'featured'		=> isset($post['featured']) ? 1 : 0,
			'status'		=> isset($post['status']) ? 1 : 0,
			'publishAt'		=> $publishAt['date'] . $publishAt['time'],
			'createOn'		=> time(),
		];

		//	Execute create post basic.
		$this->insert($basic);

		//	Get last inserted post id
		$bodyId = $this->db->insert_id();

		$bodyData = [
			'postId'			=> $bodyId,
			'metaKeyword'		=> serialize($post['metaKeyword']),
			'metaDescription'	=> $post['metaDescription'],
			'content'			=> htmlspecialchars($post['post_content']),
			'enableComment'		=> isset($post['enableComment']) ? 1 : 0
		];

		//	Insert post body content
		$this->db->insert('posts_body', $bodyData);
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
		return $this->db->count_all_results('posts');
	}

	protected function selectByGet($params = [], $userKeyword = '')
	{
		if ( ! empty($params['categories']))
		{
			$this->db->where('posts.categories', $params['categories']);
		}

		/*if ( ! empty($params['status']))
		{
			$this->db->where_in('status', $params['status']);
		}*/

		if ( ! empty($userKeyword))
		{
			$this->db
				->like('posts.metaTitle', trim($userKeyword))
				->or_like('posts.summary', trim($userKeyword))
				->or_like('posts.tag', trim($userKeyword));
		}
	}

	public function getManyBy($params = [])
	{
		if ( ! empty($params['category']))
		{
			$this->db->where('posts_categories.id', $params['category']);
		}

		/*if ( ! empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME('.$this->db->dbprefix('posts').'.created_on))', $params['month']);
		}

		if ( ! empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME('.$this->db->dbprefix('posts').'.created_on))', $params['year']);
		}*/

		if ( ! empty($params['keywords']))
		{
			$this->db
				->like('posts.title', trim($params['keywords']))
				->or_like('admin_users_profile.displayName', trim($params['keywords']));
		}

		// Is a status set?
		if ( ! empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('status', 0);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('status', 1);
		}

		// By default, dont show future posts
		if ( ! isset($params['show_future']) || (isset($params['show_future']) && $params['show_future'] == FALSE))
		{
			$this->db->where('posts.createOn <=', time());
		}

		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
		{
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		}
		elseif (isset($params['limit']))
		{
			$this->db->limit($params['limit']);
		}

		return $this->getAll();
	}

	/**
	 * Get featured post.
	 *
	 * @return bool | array
	 */
	public function getFeatured(int $limit = 0)
	{
		if ( ! $limit )
		{
			return FALSE;
		}

		$this->db
			->select([
				'posts.*',
				'admin_users_profile.displayName userDisplayName',
				'posts_categories.name categoriesName'
			])
			->order_by('createOn', 'desc')
			->where('posts.featured', 1)
			->join('admin_users_profile', 'posts.userId = admin_users_profile.userId')
			->join('posts_categories', 'posts_categories.id = posts.categories')
			->limit($limit);

		return parent::getAll();
	}
}