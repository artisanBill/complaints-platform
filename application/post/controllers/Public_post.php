<?php

class Public_post extends Site_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('post_categories_model', 'categories_model');
		$this->load->model(['post_model', 'users/user_model']);
		$this->load->library('comments/comments');
	}

	/**
	 * Displays one or more Articles.
	 *
	 * @param  int|integer $postId
	 * @return void
	 */
	public function index(int $postId = 0)
	{
		$baseWhere = $this->filterData('data');

		$userKeyword = '';

		if ( isset($baseWhere['userkeyword']) )
		{
			$userKeyword = $baseWhere['userkeyword'];
			unset($baseWhere['userkeyword']);
		}

		if ( $postId )
		{
			$baseWhere['categories'] = $postId;
		}

		//	Categories
		$categories = $this->categories_model->getAll();

		// Create pagination links
		$pagination = createPagination('post/' . $postId, $this->post_model->countBy($baseWhere, $userKeyword));

		$this->db
			->select([
				'posts.*',
				'admin_users_profile.displayName userDisplayName',
				'posts_body.metaKeyword as bodyMetaKeyword', 
				'posts_categories.name categoriesName'
			])
			->order_by('createOn', 'desc')
			->join('admin_users_profile', 'posts.userId = admin_users_profile.userId')
			->join('posts_body', 'posts_body.postId = posts.id')
			->join('posts_categories', 'posts_categories.id = posts.categories')
			->limit($pagination['limit'], $pagination['offset']);
			//userId
		$postData = $this->post_model->getManyByAll($baseWhere, $userKeyword);

		$this->template
			->title('资讯报道')
			->set_metadata('og:title', '资讯报道 &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'news', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', '', 'og')
			->set_metadata('og:keywords', '', 'og')
			->set('categories', $categories)
			->set('postData', $postData)
			->set('pagination', $pagination)
			->set('newPost', $this->post_model->getFeatured(8))
			->build('public/index');
	}

	/**
	 * Post details Show content.
	 *
	 * @param  int|integer $id
	 * @return void
	 */
	public function preivew(string $slug = '')
	{
		$result = $this->db->select([
			'posts.*',
			'posts_body.metaKeyword bodyMetaKeyword',
			'posts_body.metaDescription bodyMetaDescription',
			'posts_body.content bodycontent',
			'posts_body.enableComment bodyEnableComment',
			'posts_categories.name categoriesName',
			'admin_users_profile.displayName userDisplayName',
			'admin_users_profile.gender userGender',
			'admin_users_profile.job userJob',
			'admin_users_profile.website userWebsite',
		])
		->join('admin_users_profile', 'posts.userId = admin_users_profile.userId')
		->join('posts_body', 'posts_body.postId = posts.id')
		->join('posts_categories', 'posts_categories.id = posts.categories')
		->where('posts.slug', $slug)
		->get('posts')
		->row();

		$tags = [];
		if ( $result->tag )
		{
			$tags = explode(',', unserialize($result->tag));
		}

		$this->template
			->title($result->metaTitle)
			->set_metadata('og:title', $result->metaTitle . ' &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'article', 'og')
			->set_metadata('og:site_name', Setting::get('siteName'), 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', $result->bodyMetaDescription, 'og')
			->set_metadata('og:keywords', unserialize($result->bodyMetaKeyword), 'og')
			->set_metadata('description', $result->bodyMetaDescription)
			->set_metadata('keywords', unserialize($result->bodyMetaKeyword))
			->set_metadata('article:published_time', date(DATE_ISO8601, $result->createOn), 'og')
			->set('view', $result)
			->set('tags', $tags)
			->set('commnets', $this->comments)
			->set('newPost', $this->post_model->getFeatured(8))
			->build('public/details');
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