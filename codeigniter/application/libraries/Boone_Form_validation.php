<?php

class Boone_Form_validation extends CI_Form_validation
{
	/**
	 * The model class to call with callbacks
	 */
	protected $_model;

	public function __construct($rules = [])
	{
		parent::__construct($rules);
		$this->CI->load->language('extraValidation');
	}

	/**
	 * Alpha-numeric with underscores dots and dashes
	 *
	 * @param	string
	 * @return	bool
	 */
	public function alpha_dot_dash($str)
	{
		return (bool) preg_match("/^([-a-z0-9_\-\.])+$/i", $str);
	}

	public function cnmobile($str)
	{
		return preg_match('#^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^17[0-9]\d{8}$|^18[0-9]\d{8}$#', $str) ? true : false;
	}

	/**
	 * Formats an UTF-8 string and removes potential harmful characters
	 *
	 * @param	string
	 * @return	string
	 * @todo	Find decent regex to check utf-8 strings for harmful characters
	 */
	public function utf8($str)
	{
		// If they don't have mbstring enabled (suckers) then we'll have to do with what we got
		if ( ! function_exists('mb_convert_encoding'))
		{
			return $str;
		}

		$str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');

		return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}

	/**
	 * Format an error in the set error delimiters
	 *
	 * @param	string
	 * @return	void
	 */
	public function format_error($error)
	{
		return $this->_error_prefix.$error.$this->_error_suffix;
	}

	/**
	 * Valid URL
	 *
	 * @param	string
	 * @return	void
	 */
	public function valid_url($str)
	{
		if (filter_var($str, FILTER_VALIDATE_URL))
		{
			return true;
		}
		else
		{
			$this->set_message('valid_url', $this->CI->lang->line('valid_url'));
			return false;
		}
	}

	/**
	 * ID verification is legitimate
	 * @param  [type]  $str
	 * @return boolean
	 */
	public function credit_exists($num)
	{
        $key = [
            11 => "北京", 12 => "天津", 13 => "河北", 14 => "山西", 21  => "辽宁", 65 => "新疆",
            22 => "吉林", 31 => "上海", 32 => "江苏", 33 => "浙江", 34  => "安徽", 91 => "国外",
            35 => "福建", 36 => "江西", 37 => "山东", 41 => "河南", 42  => "湖北", 43 => "湖南",
            44 => "广东", 45 => "广西", 46 => "海南", 50 => "重庆", 51  => "四川", 52 => "贵州",
            53 => "云南", 54 => "西藏", 61 => "陕西", 62 => "甘肃", 63  => "青海", 64 => "宁夏",
            71 => "台湾", 81 => "香港", 82 => "澳门", 15 => "内蒙古", 23 => "黑龙江",
        ];
        $match = '#^[1-9][0-9]{5}(19[0-9]{2}|200[0-9]|2010)(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])[0-9]{3}[0-9xX]$#';
        if ( !$num || !preg_match($match, $num) )
        {
            return false;
        }
        if ( !$key[substr($num, 0, 2)] )
        {
            return false;
        }
        if ( strlen($num) == 18) {
            $n = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            $r = [1, 0, "X", 9, 8, 7, 6, 5, 4, 3, 2];
            $i = $s = $o = 0;
            for ($u = 0; $u < 17; $u++) {
                $s = $num[$u];
                $o = $n[$u];
                $i += $s * $o;
            }
            $a = $r[$i % 11];
            if ($r[$i % 11] != strtoupper($num[17])) {
                return false;
            }
        }
        return true;
	}

	/**
	 * Check Recaptcha callback
	 *
	 * Used for streams but can be used in other
	 * recaptcha situations.
	 *
	 * @param	string
	 * @return	bool
	 */
	public function check_recaptcha($val)
	{
		if ($this->CI->recaptcha->check_answer(
						$this->CI->input->ip_address(),
						$this->CI->input->post('recaptcha_challenge_field'),
						$val))
		{
			return true;
		}
		else
		{
			$this->set_message(
						'check_captcha',
						$this->CI->lang->line('recaptcha_incorrect_response'));
			
			return false;
		}
	}

}