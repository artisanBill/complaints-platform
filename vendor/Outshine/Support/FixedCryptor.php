<?php namespace Boone\Outshine\Support;

/**
 *	Class FixedCryptor
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\Support\FixedCryptor
 */

class FixedCryptor
{
	/**
	 *	This is to a certain instance.
	 *
	 *	@var		null
	 */
	protected static $instance = NULL;

	/**
	 *	Create this object instance， Used extensively for single-case model.
	 *
	 *	@param		mixed		$argument
	 *	@return		$this
	 */
	public static function getInstance(...$argument)
	{
		if ( static::$instance === NULL )
		{
			static::$instance = new static(...$argument);
		}
		return static::$instance;
	}

	/**
	 *	Resets the singleton instance.
	 */
	public static function reset()
	{
		static::$instance = NULL;
	}

	protected $publicKey;

	protected $privateKey;

	protected function __construct(string $public = '40A9706CAB11D108FE28BDB241AB676E', string $private = 'BOONE-SYSTEM')
	{
		$this->publicKey = $public;
		$this->privateKey = $private;
	}

	public function setPublic(string $public)
	{
		$this->publicKey = $public;
		return $this;
	}

	public function setPrivate(string $private)
	{
		$this->privateKey = $private;
		return $this;
	}

	public function encrypt(string $raw) : string
	{
		//	3DES encryption will MCRYPT_DES to MCRYPT_3DES
		$size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);

		//	If PaddingPKCS7, please change into PaddingPKCS7 methods.
		$input = $this->pkcs5Pad($raw, $size);

		//	3DES encryption 8 to 24
		$publicKey = str_pad($this->publicKey, 8, '0');
		$td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_CBC, '');
		if ( $this->privateKey == '' )
		{
			$privateKey = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		}
		else
		{
			$privateKey = $this->privateKey;
		}
		@mcrypt_generic_init($td, $publicKey, $privateKey);

		$data = mcrypt_generic($td, $input);

		mcrypt_generic_deinit($td);

		mcrypt_module_close($td);

		//	To convert binary conversion into bin2hex
		return base64_encode($data);
	}

	public function decrypt(string $encrypted) : string
	{
		//	To convert binary conversion into bin2hex
		$encrypted  = base64_decode($encrypted);

		//	3DES encryption 8 to 24
		$publicKey = str_pad($this->publicKey, 8, '0');

		//	3DES encryption will MCRYPT_DES to MCRYPT_3DES
		$td		 = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_CBC, '');

		if  ($this->privateKey == '' )
		{
			$privateKey = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		}
		else
		{
			$privateKey = $this->privateKey;
		}

		$ks = mcrypt_enc_get_key_size($td);

		@mcrypt_generic_init($td, $publicKey, $privateKey);

		$decrypted = mdecrypt_generic($td, $encrypted);

		mcrypt_generic_deinit($td);

		mcrypt_module_close($td);

		$y = $this->pkcs5Unpad($decrypted);

		return $y;
	}

	public function pkcs5Pad(string $text, int $blocksize) : string
	{
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	public function pkcs5Unpad(string $text) : string
	{
		$pad = ord($text{strlen($text) - 1});
		if ( $pad > strlen($text) || strspn($text, chr($pad), strlen($text) - $pad) != $pad )
		{
			return '';
		}

		return substr($text, 0, -1 * $pad);
	}

	public function PaddingPKCS7(string $data) : string
	{
		//	3DES encryption will MCRYPT_DES to MCRYPT_3DES
		$blockSize   = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);

		$paddingChar = $blockSize - (strlen($data) % $blockSize);

		$data .= str_repeat(chr($paddingChar), $paddingChar);

		return $data;
	}
}