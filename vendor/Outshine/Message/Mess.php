<?php namespace Boone\Outshine\Message;

define('SCRIPT_ROOT',  dirname(__FILE__).'/');

class Mess
{
	/**
	 *	Message configuration.
	 *
	 *	@var  array
	 */
	protected static $config = [
		//	网关地址
		'gwUrl'			=> 'http://sdk4report.eucp.b2m.cn:8080/sdk/SDKService',
		//	序列号,请通过亿美销售人员获取
		'serialNumber'	=> '',
		//	密码,请通过亿美销售人员获取
		'password'		=> '',
		//	登录后所持有的SESSION KEY，即可通过login方法时创建
		'sessionKey'	=> '',
		//	连接超时时间，单位为秒
		'connectTimeOut'=> 2,
		//	远程信息读取超时时间，单位为秒
		'readTimeOut'	=> 10,
		/**
		 *	proxyhost		可选，代理服务器地址，默认为 false ,则不使用代理服务器
		 *	proxyport		可选，代理服务器端口，默认为 false
		 *	proxyusername	可选，代理服务器用户名，默认为 false
		 *	proxypassword	可选，代理服务器密码，默认为 false
		 */
		'proxyhost' 	=> FALSE,
		'proxyport' 	=> FALSE,
		'proxyusername' => FALSE,
		'proxypassword' => FALSE
	];

	/**
	 *	Get Client object instance.
	 *
	 *	@var		null
	 */
	protected static $client = NULL;

	/**
	 * Create client object instanc.
	 *
	 * @return Client
	 */
	protected static function client(string $charset = 'UTF-8')
	{
		if ( static::$client === NULL )
		{
			require_once (__DIR__ . '/include/Client.php');
			static::$client = new \Client(static::$config['gwUrl'],
				static::$config['serialNumber'],
				static::$config['password'],
				static::$config['sessionKey'],
				static::$config['proxyhost'],
				static::$config['proxyport'],
				static::$config['proxyusername'],
				static::$config['proxypassword'],
				static::$config['connectTimeOut'],
				static::$config['readTimeOut']
			);
		}
		static::$client->setOutgoingEncoding($charset);
		return static::$client;
	}

	/**
	 * Send SMS text message.
	 *
	 * @param  string | array $mobile
	 * @param  string $content [description]
	 * @return int
	 */
	public static function sms(string $mobile, string $content)
	{
		/*$number = [];
		if ( is_string($mobile) )
		{
			$number[] = $mobile;
		}
		else
		{
			$number = $mobile;
		}*/
		$cont = trim('【投诉网】' . $content);

		return static::client()->sendSMS([$mobile], $cont);
	}

	/**
	 * Send voice message.
	 *
	 * @param  string | array $mobile
	 * @param  string	$content
	 * @return int
	 */
	public static function voice($mobile, string $content)
	{
		return static::client()->sendVoice([$mobile], $content);
	}

	/**
	 * Get balance.
	 *
	 * @return int
	 */
	public static function getBalance()
	{
		return static::client()->getBalance();
	}

	/**
	 * Constructor
	 *
	 *	This static, disable new object.
	 */
	private function __construct()
	{

	}
}