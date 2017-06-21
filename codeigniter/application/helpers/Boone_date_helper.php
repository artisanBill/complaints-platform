<?php

if (!function_exists('formatDate'))
{

	/**
	 * Formats a timestamp into a human date format.
	 *
	 * @param int $unix The UNIX timestamp
	 * @param string $format The date format to use.
	 * @return string The formatted date.
	 */
	function formatDate($unix, $format = '')
	{
		if ($unix == '' || !is_numeric($unix))
		{
			$unix = strtotime($unix);
		}

		if (!$format)
		{
			$format = Settings::get('dateFormat');
		}

		return strstr($format, '%') !== false ? ucfirst(utf8_encode(strftime($format, $unix))) : date($format, $unix);
	}

}

function userConstellation(string $birth = '')
{
	if( strstr($birth,'-')===false&&strlen($birth)!==8)
	{
		$birth=date("Y-m-d",$birth);
	}
	if( strlen($birth)===8)
	{
		if( eregi('([0-9]{4})([0-9]{2})([0-9]{2})$',$birth,$bir))
		$birth="{$bir[1]}-{$bir[2]}-{$bir[3]}";
	}
	if( strlen($birth)<8)
	{
		return false;
	}
	$tmpstr= explode('-',$birth); 
	if( count($tmpstr)!==3)
	{
		return false;
	}
	$y=(int)$tmpstr[0]; 
	$m=(int)$tmpstr[1]; 
	$d=(int)$tmpstr[2]; 
	$result = []; 
	$xzdict = ['摩羯','水瓶','双鱼','白羊','金牛','双子','巨蟹','狮子','处女','天秤','天蝎','射手']; 
	$zone=[1222,122,222,321,421,522,622,722,822,922,1022,1122,1222]; 
	if( (100*$m+$d) >= $zone[0] || (100*$m+$d) < $zone[1] )
	{ 
		$i=0; 
	}
	else
	{
		for( $i=1;$i<12;$i++ )
		{ 
			if( (100*$m+$d)>=$zone[$i]&&(100*$m+$d)<$zone[$i+1])
			{
				break;
			} 
		} 
	} 
	return $xzdict[$i] . '座';
	/*$sxdict=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪'); 
	$result['sx'] = $sxdict[(($y-4) % 12)]; */
	//return $result; 
}

function userBirthday(string $birthday)
{
	list($year,$month,$day) = explode("-",$birthday);
	$yearDiff = date("Y") - $year;
	$monthDiff = date("m") - $month;
	$dayDiff  = date("d") - $day;
	if ($dayDiff < 0 || $monthDiff < 0)
	{
		$yearDiff--;
	}
	return $yearDiff;
}