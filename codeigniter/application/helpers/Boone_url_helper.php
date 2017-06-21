<?php
function iplocation( $queryIP )
{
	$url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP; 
	$ch = curl_init($url); 
	curl_setopt($ch,CURLOPT_ENCODING ,'gb2312'); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$result = mb_convert_encoding($result, "utf-8", "gb2312");
	curl_close($ch); 
	preg_match("@<span>(.*)</span></p>@iU",$result,$ipArray); 
	$loc = $ipArray[1];
	if ( strstr($loc, '期待您的分享') )
	{
		$loc = '未知地理位置';
	}
	return $loc; 
}

function bankAll(string $slug = '')
{
	$bank = [
		'ccb' => '中国建设银行',
		'abc' => '中国农业银行',
		'icbc' => '中国工商银行',
		'aoc' => '中国银行',
		'cmb' => '招商银行',
		'bcm' => '交通银行',
	];

	return isset($bank[$slug]) ? $bank[$slug] : $bank;
}

function teamJob(string $key = '')
{
	$arr = [
		'lawyer'		=> '律师',
		'industry'		=> '行业专家',
		'penman'		=> '作家',
		'developer'		=> '开发者',
		'designers'		=> '设计师',
		'reporter'		=> '记者',
	];

	if ( $key )
	{
		return $arr[$key];
	}

	return $arr;
}

if ( ! function_exists('app_url') )
{
	/**
	 * [app_url description]
	 * @param  [type] $change [description]
	 * @param  string $arg    [description]
	 * @return [type]         [description]
	 */
	function app_url($change, $arg = '')
	{
		if ( strstr($change, '.') )
		{
			$change = str_replace('.', '', $change);
		}
		else
		{
			$change .= '.';
		}

		if ( Boone_Config::subdomain() )
		{
			return str_replace(Boone_Config::subdomain() . '.', $change, site_url($arg));
		}

		$vhost = Boone_Config::siteHost();
		return str_replace($vhost, $change . $vhost, site_url($arg));
	}
}

if ( ! function_exists('asset_url') )
{
	/**
	 * [asset_url description]
	 * @param  [type] $change [description]
	 * @param  string $arg    [description]
	 * @return [type]         [description]
	 */
	function asset_url($change, $arg = '')
	{
		if ( strstr($change, '.') )
		{
			$change = str_replace('.', '', $change);
		}
		else
		{
			$change .= '.';
		}

		if ( ! empty(Boone_Config::subdomain()) )
		{
			return str_replace(Boone_Config::subdomain() . '.', $change, base_url($arg));
		}

		$vhost = Boone_Config::siteHost();
		return str_replace($vhost, $change . $vhost, base_url($arg));
	}
}

if ( ! function_exists('complainType') )
{
	/**
	 * [complainType description]
	 * @return array
	 */
	function complainType($selected = '--')
	{
		$data = [
			''						=> '事件类型',
			'website'				=> '网站',
			'ecsupplier'			=> '电商',
			'company'				=> '企业',
			'organization'			=> '组织',
			'lawenforcement'		=> '政府',
			'store'					=> '店铺',
			'persion'				=> '个人',
		];

		return isset($data[$selected]) ? $data[$selected] : $data;
	}
}

if ( ! function_exists('regionList') )
{
	/**
	 * [regionList description]
	 * @return array
	 */
	function regionList($selected = '--')
	{
		$data = [
			''				=> '地区',
			'beijing'		=> '北京',
			'shanghai'		=> '上海',
			'tianjing'		=> '天津',
			'chongqing'		=> '重庆',
			'hebei'			=> '河北',
			'shanxi'		=> '山西',
			'neimenggu'		=> '内蒙古',
			'liaoning'		=> '辽宁',
			'jilin'			=> '吉林',
			'heilongjiang'	=> '黑龙江',
			'jiangsu'		=> '江苏',
			'zejiang'		=> '浙江',
			'anhui'			=> '安徽',
			'fujian'		=> '福建',
			'jianxi'		=> '江西',
			'shandong'		=> '山东',
			'henan'			=> '河南',
			'hubei'			=> '湖北',
			'hunan'			=> '湖南',
			'guangdong'		=> '广东',
			'guangxi'		=> '广西',
			'hainan'		=> '海南',
			'sichuan'		=> '四川',
			'guizhou'		=> '贵州',
			'yunnan'		=> '云南',
			'xizhang'		=> '西藏',
			'sanxi'			=> '陕西',
			'gansu'			=> '甘肃',
			'qinghai'		=> '青海',
			'ningxia'		=> '宁夏',
			'xinjiang'		=> '新疆'
		];
		return isset($data[$selected]) ? $data[$selected] : $data;
	}
}

/**
 * [userTag description]
 * @param  string $str [description]
 * @return [type]      [description]
 */
function userTag(string $str = '') : array
{
	if ( ! $str )
	{
		return [];
	}

	return explode(',', unserialize($str));
}

if ( ! function_exists('currentCaseActive') )
{
	/**
	 * The current status of the case.
	 *
	 * @return array
	 */
	function currentCaseActive($selected = '--')
	{
		$data = [
			''					=> '事件状态',
			'exposure'			=> '曝光',
			'hasReported'		=> '已报案',
			'sue'				=> '已起诉',
			'complain12315'		=> '12315投诉',
			'aicRights'			=> '工商局维权'
		];
		return isset($data[$selected]) ? $data[$selected] : $data;
	}
}

if (!function_exists('urlTitle'))
{

	/**
	 * Create URL Title
	 *
	 * Takes a "title" string as input and creates a human-friendly URL string
	 * with either a dash or an underscore as the word separator.
	 * Cyrillic alphabet characters are supported.
	 *
	 * @param string  $str       The string
	 * @param string  $separator The separator, dash or underscore.
	 * @param boolean $lowercase Whether it should be converted to lowercase.
	 *
	 * @return string The URL slug
	 */
	function urlTitle($str, $separator = 'dash', $lowercase = false)
	{
		$replace = ($separator == 'dash') ? '-' : '_';

		$trans = array(
			'&\#\d+?;' => '',
			'&\S+?;' => '',
			'\s+' => $replace,
			'[^a-z0-9\-\._]' => '',
			$replace.'+' => $replace,
			$replace.'$' => $replace,
			'^'.$replace => $replace,
			'\.+$' => ''
		);

		$str = convert_accented_characters($str);
		$str = strip_tags($str);

		foreach ($trans as $key => $val)
		{
			$str = preg_replace("#".$key."#i", $val, $str);
		}

		if ($lowercase === true)
		{
			if (function_exists('mb_convert_case'))
			{
				$str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
			}
			else
			{
				$str = strtolower($str);
			}
		}

		$CI = & get_instance();
		$str = preg_replace('#[^'.$CI->config->item('permitted_uri_chars').']#i', '', $str);

		return trim(stripslashes($str));
	}

}

function userSex(string $string = 'male' )
{
	if ( $string === 'male')
	{
		return '先生';
	}
	return '女士';
}

function timeTran(int $time){
	$t=time()-$time;
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        '604800'=>'星期',
        '86400'=>'天',
        '3600'=>'小时',
        '60'=>'分钟',
        '1'=>'秒'
    );
    foreach ($f as $k=>$v)    {
        if (0 !=$c=floor($t/(int)$k)) {
            return $c.$v.'前';
        }
    }
}