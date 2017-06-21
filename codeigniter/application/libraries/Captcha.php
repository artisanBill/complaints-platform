<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.scuio.com All rights reserved.
// +----------------------------------------------------------------------
// | 验证码
// +----------------------------------------------------------------------
// | Author: 绝版小强
// +----------------------------------------------------------------------

class Captcha
{
    protected $config = [
        'seKey'    => 'ITOUSU.NET', // 验证码加密密钥
        'codeSet'  => '2345678ABCDEFGHJKLMNPQRTUVWXY', // 验证码字符集合
        'expire'   => 1800, // 验证码过期时间（s）
        'useImgBg' => FALSE, // 使用背景图片
        'fontSize' => 24, // 验证码字体大小(px)
        'useCurve' => TRUE, // 是否画混淆曲线
        'useNoise' => TRUE, // 是否添加杂点
        'imageH'   => 0, // 验证码图片高度
        'imageW'   => 0, // 验证码图片宽度
        'length'   => 4, // 验证码位数
        'fontttf'  => 'Keyboard.ttf', // 验证码字体，不设置随机获取
        'bg'       => [255, 255, 255], // 背景颜色
        'reset'    => TRUE, // 验证成功后是否重置
    ];

    private $_image = null; // 验证码图片实例
    private $_color = null; // 验证码字体颜色

    protected $session = NULL;

    /**
     * 架构方法 设置参数
     * @access public
     * @param  array $config 配置参数
     */
    public function __construct($session, $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->session = $session;
    }

    /**
     * 使用 $this->name 获取配置
     * @access public
     * @param  string $name 配置名称
     * @return multitype    配置值
     */
    public function __get($name)
    {
        return $this->config[$name];
    }

    /**
     * 设置验证码配置
     * @access public
     * @param  string $name 配置名称
     * @param  string $value 配置值
     * @return void
     */
    public function __set($name, $value)
    {
        if (isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 检查配置
     * @access public
     * @param  string $name 配置名称
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->config[$name]);
    }

    /**
     * 验证验证码是否正确
     * @access public
     * @param string $code 用户验证码
     * @param string $id 验证码标识
     * @return bool 用户验证码是否正确
     */
    public function check($code, $id = '')
    {
        $key = $this->authcode($this->seKey) . $id;

        // 验证码不能为空
        $secode = $this->session->userdata($key . $id);//session($key);
        if (empty($code) || empty($secode)) {
            return FALSE;
        }
        // session 过期
        if (time() - $secode['verify_time'] > $this->expire) {
            $this->session->unset_userdata($key . $id);
            return FALSE;
        }

        if ($this->authcode(strtoupper($code)) == $secode['verify_code']) {
            $this->reset && $this->session->unset_userdata($key . $id);
            return TRUE;
        }

        return FALSE;
    }

    /**
     * 输出验证码并把验证码的值保存的session中
     * 验证码保存到session的格式为： array('verify_code' => '验证码值', 'verify_time' => '验证码创建时间');
     * @access public
     * @param string $id 要生成验证码的标识
     * @return void
     */
    public function entry($id = '')
    {
        // 图片宽(px)
        $this->imageW || $this->imageW = ($this->length + 2) * $this->fontSize - 20;
        // 图片高(px)
        $this->imageH || $this->imageH = $this->fontSize * 1.5;
        // 建立一幅 $this->imageW x $this->imageH 的图像
        $this->_image = imagecreate($this->imageW, $this->imageH);
        // 设置背景
        imagecolorallocate($this->_image, $this->bg[0], $this->bg[1], $this->bg[2]);
        // 验证码字体随机颜色
        $this->_color = imagecolorallocate($this->_image, 0, 0, 0);
        // 验证码使用随机字体
        $ttfPath = BOONE . 'public/resources/site/font/';//Keyboard.ttf

        if (empty($this->fontttf)) {
            $dir  = dir($ttfPath);
            $ttfs = [];
            while (FALSE !== ($file = $dir->read())) {
                if ($file[0] != '.' && substr($file, -4) == '.ttf') {
                    $ttfs[] = $file;
                }
            }
            $dir->close();
            $this->fontttf = $ttfs[array_rand($ttfs)];
        }
        $this->fontttf = $ttfPath . $this->fontttf;

        if ($this->useCurve) {
            // 绘干扰线
            $this->_creat_line();
        }

        // 绘验证码
        $code   = []; // 验证码
        $codeNX = 0; // 验证码第N个字符的左边距

        for ($i = 0; $i < $this->length; $i++)
        {
            $code[$i] = $this->codeSet[mt_rand(0, strlen($this->codeSet) - 1)];
            $codeNX += $this->imageW / ($this->length + 1.8);
            // 验证码字体随机颜色
            $this->_color = imagecolorallocate($this->_image, mt_rand(0, 150), mt_rand(0, 100), mt_rand(0, 155));
            imagettftext($this->_image, $this->fontSize, mt_rand(-20, 20), $codeNX, ($this->imageH + $this->fontSize) / 2.1, $this->_color, $this->fontttf, $code[$i]);
        }

        if ($this->useNoise) {
            // 绘杂点
            // $this->_writeNoise();
            //绘字母杂点
            //$this->_writeLetterNoise();
        }

        // 保存验证码
        $key            = $this->authcode($this->seKey);
        $code           = $this->authcode(strtoupper(implode('', $code)));
        $secode         = [];
        $secode['verify_code'] = $code; // 把校验码保存到session
        $secode['verify_time'] = time(); // 验证码创建时间

        //session($key . $id, $secode);

       // var_dump($secode);exit;
        $this->session->set_userdata([$key . $id=>$secode]);
        imagecolortransparent($this->_image, null);

        // 设置头
        header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header("content-type: image/png");
        // 设置透明
        
        // 输出图像
        imagepng($this->_image);
        imagedestroy($this->_image);
    }

    /**
     * 画一条由两条连在一起构成的随机正弦函数曲线作干扰线(你可以改成更帅的曲线函数)
     *
     */
    private function _creat_line()
    {
        for ($k = 0; $k < mt_rand(6, 10); $k++) {
            $px = $py = 0;
            // 曲线前部分
            $A = mt_rand(1, 3); // 振幅
            $b = mt_rand(-$this->imageH / 1.5, $this->imageH / 2); // Y轴方向偏移量
            $f = mt_rand(-$this->imageH / 2, $this->imageH / 4); // X轴方向偏移量
            $T = mt_rand($this->imageH, $this->imageW * 2); // 周期
            $w = (1 * M_PI) / $T;

            $px1 = mt_rand(5, $this->imageW * 1.2); // 曲线横坐标起始位置
            $px2 = $this->imageW / 1.5; // 曲线横坐标结束位置

            for ($px = $px1; $px <= $px2; $px = $px + 1) {
                if ($w != 0) {
                    $py = $A * sin($w * $px + $f) + $b + $this->imageH / 2; // y = Asin(ωx+φ) + b
                    $i  = (int) mt_rand($this->fontSize / 1.2, $this->fontSize * 1.5);
                    while ($i > 0) {
                        imagesetpixel($this->_image, $px + $i, $py, $this->_color); // 这里(while)循环画像素点比imagettftext和imagestring用字体大小一次画出（不用这while循环）性能要好很多
                        $i--;
                    }
                }
            }
        }
    }

    /**
     * 画字母杂点
     * 往图片上写不同颜色的字母或数字
     */
    private function _writeLetterNoise()
    {
        $codeSet = '1234567890oiupytrewqasffghjklmnbvcxz';
        for ($i = 0; $i < 10; $i++) {
            //杂点颜色
            $noiseColor = imagecolorallocate($this->_image, mt_rand(150, 225), mt_rand(150, 200), mt_rand(150, 225));
            for ($j = 0; $j < 5; $j++) {
                // 绘杂点
                imagestring($this->_image, 1, mt_rand(-10, $this->imageW), mt_rand(-10, $this->imageH), $codeSet[mt_rand(0, 29)], $noiseColor);
            }
        }
    }

    /**
     * 画杂点
     */
    private function _writeNoise()
    {
        for ($i = 0; $i < rand(200, 320); $i++) {
            //杂点颜色
            $noiseColor = imagecolorallocate($this->_image, mt_rand(150, 225), mt_rand(150, 200), mt_rand(150, 225));
            imagesetpixel($this->_image, rand(0, $this->imageW), rand(0, $this->imageH), $noiseColor);
        }
    }

    /* 加密验证码 */
    private function authcode($str)
    {
        $key = substr(md5($this->seKey), 5, 8);
        $str = substr(md5($str), 8, 10);
        return md5($key . $str);
    }

}
