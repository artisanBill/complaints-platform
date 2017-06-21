<?php

/**
 *	Class Honesty_model.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/honesty/models/Honesty_model.php
 */

class Honesty_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'honestys';

	/**
	 * Users begin to create an event occurs, before the user has validated form.
	 *
	 * @param array $post
	 * @return bool
	 */
	public function createEvent(array $post)
	{
		$this->db->trans_begin();
		$insert = [
			'memberId'			=> $this->currentUser->id,
			'segmentUrl'		=> strtolower(static::quickRandom(rand(10,15))) . (microtime() + time()),
			'eventRegion'		=> $post['eventRegion'],
			'eventType'			=> $post['eventType'],
			'metaTitle'			=> $post['metaTitle'],
			'metaKeyword'		=> $post['metaKeyword'],
			'metaDescription'	=> $post['metaDescription'],
			'eventDateOn'		=> $post['eventDateOn'],
			'involveAmount'		=> $post['involveAmount'],
			'casesReceipt'		=> $post['casesReceipt'],
			'eventActive'		=> $post['eventActive'],
			'siteUrl'			=> $post['siteUrl'],
			'createOn'			=> time()
		];

		parent::insert($insert);

		$bodyData = [
			'honestyId'		=> $this->db->insert_id(),
			'content'		=> $post['content'],
			'allowComment'	=> $post['allowComment'],
			'ipAddress'		=> $this->input->ip_address(),
		];

		$this->db->insert('honestys_body', $bodyData);

		if ( $this->db->trans_status() === FALSE )
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		$this->db->trans_commit();
		return TRUE;
	}

	public function countBy($params = [], $keyword = NULL, $isUser = FALSE)
	{
		$this->filter($params, $keyword, $isUser);
		return $this->db->count_all_results($this->table);
	}

	public function getManyByAll($params = [], $keyword = NULL, $isUser = FALSE)
	{
		$this->filter($params, $keyword, $isUser);
		return $this->getAll();
	}

	private function filter($params = [], $keyword = NULL, $isUser = FALSE)
	{
		if ( ! empty($params['eventRegion']))
		{
			$this->db->where('honestys.eventRegion', $params['eventRegion']);
		}
		if ( ! empty($params['eventType']))
		{
			$this->db->where_in('honestys.eventType', $params['eventType']);
		}
		if ( ! empty($params['eventActive']))
		{
			$this->db->where_in('honestys.eventActive', $params['eventActive']);
		}

		if ( $isUser === TRUE )
		{
			$this->db->where_in('honestys.memberId', $this->currentUser->id);
		}

		if ( ! empty($keyword) )
		{
			$this->db
				->like('honestys.metaTitle', trim($keyword))
				->or_like('honestys.metaKeyword', trim($keyword))
				->or_like('honestys.siteUrl', trim($keyword));
		}
	}
}