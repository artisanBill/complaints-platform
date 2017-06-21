<?php

class Admin_basic extends Admin_Controller
{
	/**
	 * Validation array
	 * 
	 * @var array
	 */
	private $rules = [];

	/**
	 * Constructor method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('settings/setting_model');
		$this->load->library('settings/setting');
		$this->load->library('form_validation');
		$this->lang->load('settings/setting');
		$this->template->activeSection = $this->uri->segment(2) ?  : 'general' ;
		//$this->template->append_js('module::setting.js');
		//$this->template->append_css('module::setting.css');
	}

	/**
	 * Index method, lists all generic settings
	 *
	 * @return void
	 */
	public function index($segmentSlug = 'general')
	{
		$settingLanguage = [];
		$settingSections = [];
		$settings = $this->setting_model->getManyBy(['isGui' => 1, 'module' => $segmentSlug]);

		// Loop through each setting
		foreach ($settings as $key => $setting)
		{
			$setting->formControl = $this->setting->formControl($setting);

			if (empty($setting->module))
			{
				$setting->module = '';
			}

			$settingLanguage[$setting->module] = [];

			if ( $setting->module !== 'general' && $setting->module)
			{
				$this->lang->load($setting->module . '/settings');
			}

			//$settings[$setting->module][] = $setting;

			//unset($settings[$key]);
		}

		// Render the layout
		$this->template
			->title($this->moduleDetails['name'])
			->build('admin/index', compact('settingSections', 'settings', 'segmentSlug'));	
	}

	/**
	 * Edit an existing settings item
	 *
	 * @return void
	 */
	public function update($segmentSlug = '')
	{
		$settings = $this->setting_model->getManyBy(['isGui'=>1, 'module'=> $segmentSlug]);

		// Create dynamic validation rules
		foreach ($settings as $setting)
		{
			$this->rules[] = [
				'field' => $setting->slug . (in_array($setting->type, ['select-multiple', 'checkbox']) ? '[]' : ''),
				'label' => 'lang:setting.' . $setting->slug . '.title',
				'rules' => 'trim'.($setting->isRequired ? '|required' : '') . ($setting->type !== 'textarea' ? '|max_length[255]' : '')
			];
		}

		// Set the validation rules
		$this->form_validation->set_rules($this->rules);

		// Got valid data?
		if ($this->form_validation->run())
		{
			$settingsStored = [];
			
			// Loop through again now we know it worked
			foreach ($settings as $setting)
			{
				$newValue = $this->input->post($setting->slug, FALSE);

				// Store arrays as CSV
				if (is_array($newValue))
				{
					$newValue = implode(',', $newValue);
				}

				// Only update passwords if not placeholder value
				if ($setting->type === 'password' and $newValue === 'XXXXXXXXXXXX')
				{
					continue;
				}

				// Dont update if its the same value
				if ($newValue != $setting->value)
				{
					Setting::set($setting->slug, $newValue);

					$settingsStored[$setting->slug] = $newValue;
				}
			}
			
			// Fire an event. Yay! We know when settings are updated. 
			Events::trigger('settings_updated', $settingsStored);

			// Success...
			$this->session->set_flashdata('success', lang('message.saveSuccess'));
		}
		elseif (validation_errors())
		{
			$this->session->set_flashdata('error', validation_errors());
		}

		redirect('setting/settings/' . $segmentSlug);
	}

	/**
	 * Sort settings items
	 *
	 * @return void
	 */
	public function ajaxUpdateOrder()
	{
		$slugs = explode(',', $this->input->post('order'));

		$i = 1000;
		foreach ($slugs as $slug)
		{
			$this->setting_model->update($slug, [
				'order' => $i--,
			]);
		}
	}
}