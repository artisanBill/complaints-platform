<?php
use Boone\Outshine\Support\FixedCryptor;
/**
 *	Class User_teams.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */

class User_teams extends User_Controller
{
	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'fullname',
			'label' => '同意条款',
			'rules' => 'trim|required|callback_onApprove',
			'errors'	=> [
				'required'	=> '您的姓名不能为空',
			]
		],
		[
			'field' => 'industrys',
			'label' => '身份',
			'rules' => 'trim|required',
			'errors'	=> [
				'required'	=> '您的身份不能为空',
			]
		],
		[
			'field' => 'userAvater',
			'label' => '照片',
			'rules' => 'trim|required',
			'errors'	=> [
				'required'	=> '请上传您的真人照片',
			]
		],
		[
			'field' => 'cardNumber',
			'label' => '身份证号码',
			'rules' => 'trim|required|callback_isCardExist',
			'errors'	=> [
				'required'	=> '您的身份证号码不能为空',
			]
		],
		[
			'field' => 'experience',
			'label' => '行业经验',
			'rules' => 'trim|required',
			'errors'	=> [
				'required'	=> '您的行业经验不能为空',
			]
		],
		[
			'field' => 'reasons',
			'label' => '加入理由',
			'rules' => 'trim|required|htmlspecialchars',
			'errors'	=> [
				'required'	=> '加入理由不能为空',
			]
		],
	];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_teams_model');
		$this->load->library('form_validation');

		$this->checkUserInfo();

		$check = $this->member_teams_model->getBy(['userId' => $this->currentUser->id]);
		if ( $check )
		{
			$this->session->set_flashdata('error', '您已经申请，请勿重新申请.');
			redirect();
		}
	}

	public function index()
	{
		if ( ($post = $this->input->post()) )
		{
			$this->form_validation->set_rules($this->rules);
			if ( $this->form_validation->run() )
			{
				$vocational = $post['vocational'] ?? '';
				$insert = [
					'userId'		=> $this->currentUser->id,
					'fullname'		=> $post['fullname'],
					'industrys'		=> $post['industrys'],
					'cardNumber'	=> $this->isCardExist(),
					'vocational'	=> $vocational,
					'experience'	=> $post['experience'],
					'userAvater'	=> $post['userAvater'],
					'reasons'		=> $post['reasons'],
					'createdOn'		=> time()
				];

				$this->member_teams_model->insert($insert);

				$this->session->set_flashdata('success', '您已经成功申请团队入驻, 审核我们会尽快通知您!请查看个人中心信件通知');
				redirect();
			}
		}

		$userInfo = new stdClass;
		foreach ( $this->rules as $field )
		{
			$userInfo->{$field['field']} = set_value($field['field']);
		}
		$this->template
			->title('团队申请')
			->set('userInfo', $userInfo)
			->build('team/join/index');
	}

	public function onApprove()
	{
		if ( $this->input->post('onApprove') )
		{
			return TRUE;
		}
		$this->form_validation->set_message('onApprove', '您必须同意加入投诉网团队协议.');
		return FALSE;
	}

	public function isCardExist()
	{
		$card = FixedCryptor::getInstance()->decrypt($this->currentUser->card);

		if ( $card != $this->input->post('cardNumber'))
		{
			$this->form_validation->set_message('isCardExist', '您的身份号码与个人认证信息身份证号码不匹配.');
			return FALSE;
		}
		return TRUE;
	}
}