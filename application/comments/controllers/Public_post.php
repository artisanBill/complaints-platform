<?php

class Public_post extends Site_Controller
{
	/**
	 * An array containing the validation rules
	 * 
	 * @var array
	 */
	private $rules = [
		[
			'field' => 'message',
			'label' => '留言内容',
			'rules' => 'trim|required'
		],
	];

	/**
	 * Constructor method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// Load the required classes
		$this->load->library('form_validation');
		$this->load->model('comment_model');
		//$this->lang->load('comments');
	}

	/**
	 * Create a new comment
	 *
	 * @param type $segment The segment that has a comment-able model.
	 * @param int $id The id for the respective comment-able model of a segment.
	 */
	public function create($segment = '')
	{
		if ( ! ($result = $this->checkModule($segment)) )
		{
			return FALSE;
		}

		if ( ! isset($this->currentUser->id) )
		{
			$this->alertMessage('请登录后留言');
		}

		$updateModel = $result['model'];

		if ( $_POST )
		{
			$this->form_validation->set_rules($this->rules);

			$post = array_merge($this->input->post(), $result);

			$inserId = $this->comment_model->insert($post);

			if ( $this->form_validation->run() && $inserId !== FALSE )
			{
				$commentCount = $result['commentCount'] + 1;

				$updateModel->update($result['id'], ['commentCount'	=> $commentCount]);

				$this->output->set_header('Content-Type: application/json; charset=utf-8');
				echo json_encode([
					'type'		=> 'success',
					'message'	=> '您已经成功留言',
					'countall'	=> $commentCount,
					'comment'	=> $inserId
				]);
				exit;
			}
		}
		$this->alertMessage('留言失败');
	}

	/**
	 * Loading message content.
	 *
	 * @param  string $slug
	 * @return void
	 */
	public function loader($slug = '')
	{
		if ( ! ($result = $this->checkModule($slug)) )
		{
			return FALSE;
		}

		$module = $result['module'];
		$pageId = $result['id'];

		//	Create tab
		$pagination = createPagination(app_url('/comments/loader/' . $module . '-' . $pageId), 
			$this->comment_model->countBy([
				'module'	=> $module,
				'urlSlug'	=> $pageId
			])
		);

		//	Get a list of data
		$comments = $this->db->select([
				'comments.*',
				'member.avatar as userAvatar',
				'member_profile.displayName as userDisplayName',
				'member_profile.gender as userGender',
			])
			->order_by('comments.createdOn', 'desc')
			->from('comments')
			->join('member', 'comments.userId = member.id', 'left')
			->join('member_profile', 'member_profile.userId = comments.userId', 'left')
			->limit($pagination['limit'], $pagination['offset'])
			->where('comments.urlSlug', $pageId)
			->where_in('comments.module', $module)
			->get()
			->result();

		if ( ! $comments )
		{
			return FALSE;
		}

		$this->template
			->set_layout(FALSE)
			->set('comments', $comments)
			->build('list');
	}

	/**
	 * Get the latest current message created by the user.
	 *
	 * @param  string $slug
	 * @return void
	 */
	public function prepend(string $slug)
	{
		if ( ! ($result = $this->checkModule($slug)) )
		{
			return FALSE;
		}

		$commentId = (int) $this->input->get('comment');

		if ( ! $commentId )
		{
			return;
		}

		$module = $result['module'];
		$pageId = $result['id'];
		$row = $this->db->select([
			'comments.*',
			'member.avatar as userAvatar',
			'member_profile.displayName as userDisplayName',
			'member_profile.gender as userGender',
		])
			->order_by('comments.createdOn', 'desc')
			->from('comments')
			->join('member', 'comments.userId = member.id', 'left')
			->join('member_profile', 'member_profile.userId = comments.userId', 'left')
			->where('comments.id', $commentId)
			->where_in('comments.urlSlug', $pageId)
			->where_in('comments.module', $module)
			->get()
			->row();

		$this->template
			->set_layout(FALSE)
			->set('comment', $row)
			->build('row');
	}

	/**
	 * Users vote request.
	 *
	 * @param  string $segment
	 * @return void
	 */
	public function uservote(string $segment)
	{
		if ( ! isset($this->currentUser->id) OR ! strpos($segment, '-') )
		{
			return FALSE;
		}

		$userId = (int) $this->input->get('guestid');

		list($vote, $commentId) = explode('-', $segment);

		$commentId = (int) $commentId;

		if ( ! ($vote != 'approval' || $vote != 'contra') || $this->checkUserIsSupport($userId, $commentId) )
		{
			return FALSE;
		}

		$model = $this->comment_model->get($commentId);

		if ( ! $model )
		{
			return FALSE;
		}

		$support = $vote . 'Count';

		$count = $model->{$support} + 1;

		$this->comment_model->update($model->id, [
			$support	=> $count
		]);

		$this->db->insert($this->db->dbprefix('comment_log'), [
			'commentId'	=> $commentId,
			'userId'	=> $userId,
			$vote		=> 1,
		]);

		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'id'		=> $model->id,
			'vote'		=> $vote,
			'allcount'	=> $count,
		]);
	}

	/**
	 * Check whether the user has thumbs up
	 *
	 * @param  int $userId
	 * @param  int $commentId
	 * @return bool
	 */
	protected function checkUserIsSupport(int $userId, int $commentId)
	{
		return (bool) $this->db->where([
			'userId'	=> $userId,
			'commentId'	=> $commentId,
		])->count_all_results($this->db->dbprefix('comment_log'));
	}

	/**
	 * Verify the existence of module.
	 *
	 * @param  string  $module
	 * @return array | bool
	 */
	protected function checkModule(string $segment)
	{
		if ( ! strpos($segment, '-') )
		{
			return FALSE;
		}

		list($module, $id) = explode('-', $segment);

		if ( ! $id )
		{
			return FALSE;
		}
		$id = (int) $id;

		$module = $this->app_model->get($module);

		if ( ! $module )
		{
			return FALSE;
		}

		try {
			$className = $module['slug'] . '_model';

			$this->load->model($module['slug'] . '/' . $className);
			$model = $this->{$className};
			$result = $model->get($id);

			if ( $result )
			{
				return [
					'id'			=> $result->id,
					'module'		=> $module['slug'],
					'model'			=> $model,
					'commentCount'	=> $result->commentCount
				];
			}

		} catch (RuntimeException $e)
		{
			return FALSE;
		}
	}

	/**
	 * User Authentication Information Form.
	 *
	 * @param  string $message
	 * @param  string $type
	 * @return void
	 */
	protected function alertMessage(string $message, string $type = 'error')
	{
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'type'		=> $type,
			'message'	=> $message,
		]);
		exit;
	}

	/**
	 * Send an email
	 *
	 * @param array $comment The comment data.
	 * @param array $entry The entry data.
	 * @return boolean 
	 */
	protected function sendEmail($comment, $entry)
	{
		$this->load->library('email');
		$this->load->library('user_agent');

		// Add in some extra details
		$comment['slug'] = 'comments';
		$comment['sender_agent'] = $this->agent->browser().' '.$this->agent->version();
		$comment['sender_ip'] = $this->input->ip_address();
		$comment['sender_os'] = $this->agent->platform();
		$comment['redirect_url'] = anchor(ltrim($entry['uri'], '/').'#'.$comment['commentId']);
		$comment['reply-to'] = $comment['user_email'];

		//trigger the event
		return (bool) Events::trigger('email', $comment);
	}

}
