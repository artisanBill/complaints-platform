<?php
use Boone\Outshine\Support\FixedCryptor;
/**
 *	Class User_honesty.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/honesty/controllers/User_honesty.php
 */

class User_honesty extends User_Controller
{
	 /**
     * Validation form rules.
     *
     * @var array
     */
    protected $rules = [
        [
            'field' => 'eventRegion',
            'label' => '地区',
            'rules' => 'trim|required|alpha',
        ],
        [
            'field' => 'eventType',
            'label' => '类型',
            'rules' => 'trim|required|alpha',
        ],
        [
            'field' => 'metaTitle',
            'label' => '名称',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'metaKeyword',
            'label' => '关键词',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'metaDescription',
            'label' => '描述',
            'rules' => 'trim|max_length[255]',
        ],
        [
            'field' => 'eventDateOn',
            'label' => '事件发生时间',
        ],
        [
            'field' => 'involveAmount',
            'label' => '涉及金额',
            'rules' => 'trim',
        ],
        [
            'field' => 'casesReceipt',
            'label' => '案件回执',
            'rules' => 'trim',
        ],
        [
            'field' => 'eventActive',
            'label' => '事件状态',
            'rules' => 'trim|required|alpha',
        ],
        [
            'field' => 'siteUrl',
            'label' => '网址',
            'rules' => 'valid_url',
        ],
        [   //1
            'field' => 'allowComment'
        ],
        [
            'field' => 'content',
            'label' => '内容',
            'rules' => 'trim|required|htmlspecialchars',
        ],
        
    ];

    protected $crypter;

     /**
      * Constructor.
      */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

        $this->load->model('honesty_model');
        $this->checkUserInfo();

        $this->crypter = FixedCryptor::getInstance();
	}

    /**
     * View my complaint.
     *
     * @return void
     */
	public function index(string $helperId = '')
	{
        $pageUrl = 'honesty';
        if ( $helperId )
        {
            $pageUrl = 'honesty/helper/' . $helperId;
            $helperId = (int) $this->crypter->decrypt($helperId);

            $changeUser = $this->member_model->get($helperId);
            if ( $changeUser )
            {
                $this->template->set('changeUser', $changeUser);
            }
        }

        $condition = $this->filterData('data');
        $keyword = '';
        if ( isset($condition['userkeyword']) )
        {
            $keyword  = $condition['userkeyword'];
            unset($condition['userkeyword']);
        }

        $pagination = createPagination($pageUrl, $this->honesty_model->countBy($condition, $keyword, TRUE));
        $this->db->select([
                'honestys.*',
                'member.avatar memberAvatar',
                'member_profile.displayName memberDisplayName',
                'member_profile.firstName memberFirstName',
                'member_profile.gender memberGender',
            ])
            ->order_by('honestys.createOn', 'desc')
            ->join('member', 'honestys.memberId = member.id')
            ->join('member_profile', 'honestys.memberId = member_profile.userId')
            ->limit($pagination['limit'], $pagination['offset']);

        $viewItems = $this->honesty_model->getManyByAll($condition, $keyword, TRUE);

		$this->template
			->title('我的列表')
            ->set('viewItems', $viewItems)
            ->set('pagination', $pagination)
            ->set('selected', $condition)
            ->set('crypter', $this->crypter)
			->build('user/index');
	}

    /**
     * Create complaints.
     *
     * @return void
     */
	public function create()
	{
        $this->template
            ->title('创建投诉')
            ->set_metadata('itousu-token', sha1($this->currentUser->id))
            ->build('create/index');
	}

    /**
     * Loading Fill out the form view.
     *
     * @return void
     */
    public function viewinput()
    {
        //  Illegal user requests data, returns error 404 page
        if ( $this->input->post('token') !== sha1($this->currentUser->id) && ! $this->input->is_ajax_request() )
        {
            show_404();
        }

        $this->template
            ->set_layout(FALSE)
            ->set('honesty', $this->formValue())
            ->build('create/input');
    }

    /**
     * Begin to create a user-initiated complaints.
     *
     * @return void
     */
    public function execute()
    {
        //  Illegal user requests data, returns error 404 page
        if ( $this->input->post('token') !== sha1($this->currentUser->id) && ! $this->input->is_ajax_request() )
        {
            show_404();
        }

        $this->form_validation->set_rules($this->rules);
        if ( $this->form_validation->run() )
        {
            if ( $this->honesty_model->createEvent($this->input->post()) )
            {
               exit(json_encode([
                    'type'    => 'success',
                    'url'      => '/honesty',
                    'message'   => '您已经成功创建投诉事件! 页面跳转中 ...'
                ]));
            }
            exit(json_encode([
                'type'    => 'error',
                'message'   => '创建事件失败!'
            ]));
        }
        echo json_encode([
            'type'  => 'error',
            'message' => validation_errors(),
        ]);
    }

    /**
     * Form values.
     *
     * @return object
     */
    private function formValue()
    {
        $honesty = new stdClass;
        foreach ( $this->rules as $field )
        {
           $honesty->{$field['field']} = set_value($field['field']);
        }
        return $honesty;
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