<?php

class Comment_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	public function getReply()
	{

	}
	
	/**
	 * Insert a new comment
	 *
	 * @param array $post The data to insert
	 * @return bool | int
	 */
	public function insert($post, $skipValidation = FALSE)
	{	
		$inesrt = parent::insert([
			'isActive'	=> 1,
			'userId'	=> $this->currentUser->id,
			'email'		=> $post['email'] ?? '',
			'title'		=> $post['title'] ?? '',
			'urlSlug'	=> $post['id'],
			'module'	=> $post['module'],
			'content'	=> $post['message'],
			'createdOn'	=> time(),
			'ipAddress'	=> iplocation($this->input->ip_address()),
		], $skipValidation);

		return $inesrt ? $this->db->insert_id() : FALSE;
	}
	
	/**
	 * Update an existing comment
	 *
	 * @param int $id The ID of the comment to update
	 * @param array $input The array containing the data to update
	 * @return void
	 */
	/*public function update($id, $input, $skip_validation = FALSE)
	{
		return parent::update($id, array(
			'user_name'		=> isset($input['user_name']) 	? 	ucwords(strtolower(strip_tags($input['user_name']))) : '',
			'user_email'	=> isset($input['user_email']) 	? 	strtolower($input['user_email']) 					 : '',
			'user_website'	=> isset($input['user_website']) ? 	prep_url(strip_tags($input['user_website'])) 		 : '',
			'comment'		=> htmlspecialchars($input['comment'], null, false),
			'parsed'		=> parse_markdown(htmlspecialchars($input['comment'], null, false)),
		));
	}*/
	
	/**
	 * Approve a comment
	 *
	 * @param int $id The ID of the comment to approve
	 * @return mixed
	 */
	public function approve($id)
	{
		return parent::update($id, array('is_active' => true));
	}
	
	/**
	 * Unapprove a comment
	 *
	 * @param int $id The ID of the comment to unapprove
	 * @return mixed
	 */
	public function unapprove($id)
	{
		return parent::update($id, array('is_active' => false));
	}
	
	/**
	 * Setting up the query for the get* functions.
	 *
	 * @param  int    $pageId
	 * @return void
	 */
	private function getAllSetup(int $pageId)
	{
		$this->table = NULL;
		$this->db->select([
				'comments.*',
				'member.avatar as userAvatar',
				'member_profile.displayName as userDisplayName',
				'member_profile.gender as userGender',
			])
			->order_by('comments.createdOn', 'desc')
			->from('comments')
			->join('member', 'comments.userId = member.id', 'left')
			->join('member_profile', 'member_profile.userId = comments.userId', 'left')
			->where('comments.urlSlug', $pageId);
	}
}
