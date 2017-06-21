<?php

/**
 *	Class Public_preview.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/honesty/controllers/Public_preview.php
 */
class Public_preview extends Site_Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('honesty_model');
		$this->load->library('comments/comments');
	}

	/**
	 * Render content of the user complaints.
	 *
	 * @return void
	 */
	public function index()
	{
		$condition = $this->filterData('data');
		$keyword = '';
		if ( isset($condition['userkeyword']) )
		{
			$keyword  = $condition['userkeyword'];
			unset($condition['userkeyword']);
		}

		$pagination = createPagination('honesty', $this->honesty_model->countBy($condition, $keyword));

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

		$viewItems = $this->honesty_model->getManyByAll($condition, $keyword);

		$this->template
			->title('投诉预览')
			->set_metadata('og:title', '投诉预览 &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'honesty', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', '曝光, 立案, 诚信查询', 'og')
			->set_metadata('og:keywords', '曝光, 立案, 诚信查询', 'og')
			->set('viewItems', $viewItems)
			->set('pagination', $pagination)
			->set('selected', $condition)
			->build('public/index');
	}

	/**
	 * A display details of the complaint.
	 *
	 * @param  string $slug
	 * @return void
	 */
	public function preview(string $slug)
	{
		$result = $this->db->select([
			'honestys.*',
			'member.avatar memberAvatar',
			'member.donation memberDonation',
			'member.createdOn memberCreatedOn',
			'member_profile.displayName memberDisplayName',
			'member_profile.firstName memberFirstName',
			'member_profile.gender memberGender',
			'member_profile.bio memberProfile',
			'honestys_body.userId as adminUser',
			'honestys_body.allowComment as memberAllowComment',
			'honestys_body.content as bodyContent',
		])
		->join('member', 'honestys.memberId = member.id')
		->join('member_profile', 'honestys.memberId = member_profile.userId')
		->join('honestys_body', 'honestys_body.honestyId = honestys.id')
		->where('honestys.segmentUrl', $slug)
		->get('honestys')
		->row();

		$this->template
			->title($result->metaTitle)
			->set_metadata('og:title', $result->metaTitle . ' &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'honesty', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', $result->metaKeyword, 'og')
			->set_metadata('og:keywords', $result->metaDescription, 'og')
			->set('view', $result)
			->set('commnets', $this->comments)
			->build('public/preview');
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