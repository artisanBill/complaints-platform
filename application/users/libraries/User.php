<?php

class User
{
	/**
	 * The ci instance.
	 *
	 * @var ci
	 */
	protected $ci;

	/**
	 *	Constructor.
	 */
	public function __construct()
	{
		$this->ci = CI::$APP;
		$this->ci->load->model('users/user_model');
		$this->ci->config->load('users/user');
	}

	public function userModel(string $user = 'admin_users', string $group = 'admin_groups', string $profile = 'admin_users_profile')
	{
		$this->ci->user_model->initialize($user, $group, $profile);

		return $this->ci->user_model;
	}

	
}