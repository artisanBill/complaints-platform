<?php

/**
 *	Class Message_model.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */
class Message_model extends Boone_Model
{
	/**
	 * The table name.
	 * 
	 * @var string
	 */
	protected $table = 'site_message';

	public function send(string $sendUser, int $accept, string $title, string $subject, string $body, int $model = 0, int $important = 0)
	{
		$data = [
			'senderUser'	=> $sendUser,
			'isAdmin'		=> $model,
			'acceptUser'	=> $accept,
			'isImportant'	=> $important,
			'title'			=> $title,
			'subject'		=> $subject,
			'content'		=> htmlspecialchars($body),
			'createdOn'		=> time()
		];

		return $this->insert($data);
	}
}