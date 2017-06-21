<?php

/**
 *	Class User_categories.php
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */
class User_categories extends User_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('categories_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ( ! $this->input->post() )
		{
			show_404();
			exit;
		}

		$this->template
			->set_layout(FALSE)
			->build('categories/index');
	}

	public function create()
	{
		if ( ! $this->input->post() )
		{
			show_404();
			exit;
		}
		$this->form_validation->set_rules(
			'cotegories', 
			'文集名称', 
			'required|max_length[100]'
		);

		if ( $this->form_validation->run() )
		{
			$cotegories = $this->input->post('cotegories');

			$id = $this->categories_model->insert([
				'userId'	=> $this->currentUser->id,
				'name'		=> $cotegories,
			]);

			$result = $this->categories_model->get($id);
			if ( $result && $result->userId == $this->currentUser->id )
			{
				$this->output->set_header('Content-Type: application/json; charset=utf-8');
				echo json_encode((array) $result);
				exit;
				/*$this->template
					->set_layout(FALSE)
					->set('item', $result)
					->build('categories/list');*/
			}
		}
		$this->alertMessage('您的文集没有添加成功.');
	}

	public function delete(int $slugId)
	{
		$this->db->where('userId', $this->currentUser->id);
		$result = $this->categories_model->get($slugId);
		if ( ! $result )
		{
			$this->alertMessage('删除失败');
		}

		$this->load->model('blog_model');

		$this->db->where('userId', $this->currentUser->id)
			->where_in('categories', $result->id);
		$count = $this->db->count_all_results('blog');

		if ( $count == 0 )
		{
			$this->categories_model->delete($result->id);
			$this->alertMessage('删除成功', 'success');
		}
		$this->alertMessage(sprintf('该文集有文章，不能删除该文集哦! ROW(%d)', $count));
	}

	public function update(int $slugId)
	{
		$this->db->where('userId', $this->currentUser->id);
		$result = $this->categories_model->get($slugId);
		if ( ! $result )
		{
			$this->alertMessage('该文集不存在');
		}
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'type'		=> 'success',
			'id'		=> $result->id,
			'name'		=> $result->name,
			'message'	=> '您正在编辑 ' . $result->name
		]);
	}

	public function editer(int $slugId)
	{
		$this->db->where('userId', $this->currentUser->id);
		$result = $this->categories_model->get($slugId);
		if ( ! $result )
		{
			$this->alertMessage('该文集不存在');
		}

		$update = $this->input->post();

		if ( ! isset($update['cotegories']) || empty($update['cotegories']) )
		{
			$this->alertMessage('该文集不能为空');
		}

		if ( ! isset($update['cotegoriesId']) || $update['cotegoriesId'] != $result->id )
		{
			$this->alertMessage('更新失败');
		}

		$this->categories_model->update($result->id, ['name' => $update['cotegories']]);

		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'id'		=> $result->id,
			'type'		=> 'success',
			'message'	=> '您已经成功更新文集',
			'name'		=> $update['cotegories']
		]);
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
}