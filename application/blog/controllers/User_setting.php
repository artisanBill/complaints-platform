<?php

/**
 *	Class User_setting.php
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */
class User_setting extends User_Controller
{
	protected $retain = [
		'admin', 'user', 'member', 'lawyer', 'expert', 'legal', 'email', 'client', 'server', 'service', 'customer',
		'itousu', 'tousu', 'china', 'reward', 'boone', 'alipay', 'tenpay', 'weixin', 'court'
	];

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$setting = $this->blog_setting_model->home();

		if ( $_POST )
		{
			$this->form_validation->set_rules(
				'blogName', 
				'博客名称', 
				'trim|required|min_length[5]|max_length[30]|callback_blogName'
			);
			$this->form_validation->set_rules(
				'domain', 
				'域名', 
				'trim|required|alpha_numeric|min_length[4]|max_length[15]|callback_blogDomain'
			);
			$this->form_validation->set_rules(
				'bio', 
				'简介', 
				'trim|required|max_length[255]'
			);
			$this->form_validation->set_rules('price', '价格', 'trim|numeric');

			if ( $this->form_validation->run() )
			{
				$update = $this->input->post();
				if ( $update['submit'] )
				{
					unset($update['submit']);
				}

				$execture = [
					'blogName'		=> $update['blogName'],
					'domain'		=> $update['domain'],
					'bank'			=> $update['bank'],
					'bankCard'		=> $update['bankCard'],
					'theme'			=> $update['theme'],
					'reward'		=> $update['reward'],
					'price'			=> $update['price'],
					'bio'			=> $update['bio'],
				];

				if ( $setting->userId == $this->currentUser->id )
				{
					$this->blog_setting_model->update($setting->id, $execture);
					$this->session->set_flashdata('success', '您已经成功更新配置');
				}
				redirect();
			}
		}

		$this->template
			->title('博客偏好设置')
			->set('setting', $setting)
			->build('settings/index');
	}

	public function blogName()
	{
		$result = $this->db->where('blogName', trim($this->input->post('blogName')))
			->where_not_in('userId', $this->currentUser->id)
			->get($this->blog_setting_model->tableName())
			->row();
		if ( $result )
		{
			$this->form_validation->set_message('blogName', sprintf('博客名称 %s 已经存在!', $this->input->post($name)));
			return FALSE;
		}
		return TRUE;
	}

	public function blogDomain()
	{
		if ( in_array(trim($this->input->post('domain')), $this->retain) )
		{
			$this->form_validation->set_message('blogDomain', sprintf('博客域名 %s 被保留!', $this->input->post('domain')));
			return FALSE;
		}

		$result = $this->db->where('domain', trim($this->input->post('domain')))
			->where_not_in('userId', $this->currentUser->id)
			->get($this->blog_setting_model->tableName())
			->row();

		if ( $result )
		{
			$this->form_validation->set_message('blogDomain', sprintf('博客域名 %s 已经存在!', $this->input->post('domain')));
			return FALSE;
		}
		return TRUE;
	}
}