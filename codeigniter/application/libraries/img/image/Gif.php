<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2002~2013 http://www.scuio.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 绝版小强 <lewis@2le.com>
// +----------------------------------------------------------------------
//namespace app\libraries\image\driver;

class Gif
{
    /**
     * GIF帧列表
     *
     * @var array
     */
    private $frames = [];

    /**
     * 每帧等待时间列表
     *
     * @var array
     */
    private $delays = [];

    /**
     * 构造方法，用于解码GIF图片
     *
     * @param string $src GIF图片数据
     * @param string $mod 图片数据类型
     */
    public function __construct($src = null, $mod = 'url')
    {
        if (!is_null($src)) {
            if ('url' == $mod && is_file($src)) {
                $src = file_get_contents($src);
            }
            /* 解码GIF图片 */
            try {
                $de           = new GIFDecoder($src);
                $this->frames = $de->GIFGetFrames();
                $this->delays = $de->GIFGetDelays();
            } catch (\Exception $e) {
                throw new \Exception("解码GIF图片出错");
            }
        }
    }

    /**
     * 设置或获取当前帧的数据
     *
     * @param  string $stream 二进制数据流
     * @return mixed        获取到的数据
     */
    public function image($stream = null)
    {
        if (is_null($stream)) {
            $current = current($this->frames);
            return false === $current ? reset($this->frames) : $current;
        }
        $this->frames[key($this->frames)] = $stream;
    }

    /**
     * 将当前帧移动到下一帧
     *
     * @return string 当前帧数据
     */
    public function nextImage()
    {
        return next($this->frames);
    }

    /**
     * 编码并保存当前GIF图片
     *
     * @param  string $gifname 图片名称
     */
    public function save($gifname)
    {
        $gif = new GIFEncoder($this->frames, $this->delays, 0, 2, 0, 0, 0, 'bin');
        file_put_contents($gifname, $gif->GetAnimation());
    }

}

/*
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::
::  GIFEncoder Version 2.0 by László Zsidi, http://gifs.hu
::
::  This class is a rewritten 'GifMerge.class.php' version.
::
::  Modification:
::   - Simplified and easy code,
::   - Ultra fast encoding,
::   - Built-in errors,
::   - Stable working
::
::
::  Updated at 2007. 02. 13. '00.05.AM'
::
::  Enhanced version by xurei (https://github.com/xurei/GIFDecoder_optimized)
::
::  Try on-line GIFBuilder Form demo based on GIFEncoder.
::
::  http://gifs.hu/phpclasses/demos/GifBuilder/
::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */
class GIFEncoder
{
    public $GIF = "GIF89a"; /* GIF header 6 bytes   */
    public $VER = "GIFEncoder V2.05"; /* Encoder version      */
    public $BUF = [];
    public $LOP = 0;
    public $DIS = 2;
    //var $COL = -1;
    public $TRANSPARENT_R = -1;
    public $TRANSPARENT_G = -1;
    public $TRANSPARENT_B = -1;
    public $IMG           = -1;
    public $ERR           = array(
        'ERR00' => "Does not supported function for only one image!",
        'ERR01' => "Source is not a GIF image!",
        'ERR02' => "Unintelligible flag ",
        'ERR03' => "Does not make animation from animated GIF source",
    );
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFEncoder...
    ::
     */
    public function __construct($GIF_src, $GIF_dly, $GIF_lop, $GIF_dis, $GIF_red, $GIF_grn, $GIF_blu, $GIF_mod)
    {
        if (!is_array($GIF_src) && !is_array($GIF_dly)) {
            printf("%s: %s", $this->VER, $this->ERR['ERR00']);
            exit(0);
        }
        $this->LOP = ($GIF_lop > -1) ? $GIF_lop : 0;
        $this->DIS = ($GIF_dis > -1) ? (($GIF_dis < 3) ? $GIF_dis : 3) : 2;
        $this->COL = ($GIF_red > -1 && $GIF_grn > -1 && $GIF_blu > -1) ?
        ($GIF_red | ($GIF_grn << 8) | ($GIF_blu << 16)) : -1;

        for ($i = 0; $i < count($GIF_src); $i++) {
            if (strToLower($GIF_mod) == "url") {
                $this->BUF[] = fread(fopen($GIF_src[$i], "rb"), filesize($GIF_src[$i]));
            } else if (strToLower($GIF_mod) == "bin") {
                $this->BUF[] = $GIF_src[$i];
            } else {
                printf("%s: %s ( %s )!", $this->VER, $this->ERR['ERR02'], $GIF_mod);
                exit(0);
            }
            if (substr($this->BUF[$i], 0, 6) != "GIF87a" && substr($this->BUF[$i], 0, 6) != "GIF89a") {
                printf("%s: %d %s", $this->VER, $i, $this->ERR['ERR01']);
                exit(0);
            }
            for ($j = (13 + 3 * (2 << (ord($this->BUF[$i]{10}) & 0x07))), $k = true; $k; $j++) {
                switch ($this->BUF[$i]{ $j}) {
                case "!":
                    if ((substr($this->BUF[$i], ($j + 3), 8)) == "NETSCAPE") {
                        printf("%s: %s ( %s source )!", $this->VER, $this->ERR['ERR03'], ($i + 1));
                        exit(0);
                    }
                    break;
                case ";":
                    $k = false;
                    break;
                }
            }
        }
        $this->GIFAddHeader();
        for ($i = 0; $i < count($this->BUF); $i++) {
            $this->GIFAddFrames($i, $GIF_dly[$i]);
        }
        $this->GIFAddFooter();
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFAddHeader...
    ::
     */
    public function GIFAddHeader()
    {
        $cmap = 0;
        if (ord($this->BUF[0]{10}) & 0x80) {
            $cmap = 3 * (2 << (ord($this->BUF[0]{10}) & 0x07));
            $this->GIF .= substr($this->BUF[0], 6, 7);
            $this->GIF .= substr($this->BUF[0], 13, $cmap);
            $this->GIF .= "!\377\13NETSCAPE2.0\3\1" . GIFEncoder::GIFWord($this->LOP) . "\0";
        }
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFAddFrames...
    ::
     */
    public function GIFAddFrames($i, $d)
    {
        $Locals_str = 13 + 3 * (2 << (ord($this->BUF[$i]{10}) & 0x07));
        $Locals_end = strlen($this->BUF[$i]) - $Locals_str - 1;
        $Locals_tmp = substr($this->BUF[$i], $Locals_str, $Locals_end);
        $Global_len = 2 << (ord($this->BUF[0]{10}) & 0x07);
        $Locals_len = 2 << (ord($this->BUF[$i]{10}) & 0x07);
        $Global_rgb = substr($this->BUF[0], 13,
            3 * (2 << (ord($this->BUF[0]{10}) & 0x07)));
        $Locals_rgb = substr($this->BUF[$i], 13,
            3 * (2 << (ord($this->BUF[$i]{10}) & 0x07)));
        $Locals_ext = "!\xF9\x04" . chr(($this->DIS[$i] << 2) + 0) .
        chr(($d >> 0) & 0xFF) . chr(($d >> 8) & 0xFF) . "\x0\x0";
        if ($this->TRANSPARENT_R > -1 && ord($this->BUF[$i]{10}) & 0x80) {
            for ($j = 0; $j < (2 << (ord($this->BUF[$i]{10}) & 0x07)); $j++) {
                if (
                    ord($Locals_rgb{3 * $j + 0}) == $this->TRANSPARENT_R &&
                    ord($Locals_rgb{3 * $j + 1}) == $this->TRANSPARENT_G &&
                    ord($Locals_rgb{3 * $j + 2}) == $this->TRANSPARENT_B) {
                    $Locals_ext = "!\xF9\x04" . chr(($this->DIS[$i] << 2)) .
                    chr(($d >> 0) & 0xFF) . chr(($d >> 8) & 0xFF) . chr($j) . "\x0";
                    break;
                }
            }
        }
        switch ($Locals_tmp{0}) {
        case "!":
            $Locals_img    = substr($Locals_tmp, 8, 10);
            $Locals_ext[3] = chr((ord($Locals_ext[3]) & 0xFE) | (ord($Locals_tmp[3]) & 0x01));
            $Locals_tmp    = substr($Locals_tmp, 18, strlen($Locals_tmp) - 18);
            break;
        case ",":
            $Locals_img = substr($Locals_tmp, 0, 10);
            $Locals_tmp = substr($Locals_tmp, 10, strlen($Locals_tmp) - 10);
            break;
        }
        if (ord($this->BUF[$i]{10}) & 0x80 && $this->IMG > -1) {
            if ($Global_len == $Locals_len) {
                if (GIFEncoder::GIFBlockCompare($Global_rgb, $Locals_rgb, $Global_len)) {
                    $this->GIF .= ($Locals_ext . $Locals_img . $Locals_tmp);
                } else {
                    $byte = ord($Locals_img{9});
                    $byte |= 0x80;
                    $byte &= 0xF8;
                    $byte |= (ord($this->BUF[0]{10}) & 0x07);
                    $Locals_img{9} = chr($byte);
                    $this->GIF .= ($Locals_ext . $Locals_img . $Locals_rgb . $Locals_tmp);
                }
            } else {
                $byte = ord($Locals_img{9});
                $byte |= 0x80;
                $byte &= 0xF8;
                $byte |= (ord($this->BUF[$i]{10}) & 0x07);
                $Locals_img{9} = chr($byte);
                $this->GIF .= ($Locals_ext . $Locals_img . $Locals_rgb . $Locals_tmp);
            }
        } else {
            $this->GIF .= ($Locals_ext . $Locals_img . $Locals_tmp);
        }
        $this->IMG = 1;
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFAddFooter...
    ::
     */
    public function GIFAddFooter()
    {
        $this->GIF .= ";";
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFBlockCompare...
    ::
     */
    public function GIFBlockCompare($GlobalBlock, $LocalBlock, $Len)
    {
        for ($i = 0; $i < $Len; $i++) {
            if (
                $GlobalBlock{3 * $i + 0} != $LocalBlock{3 * $i + 0} ||
                $GlobalBlock{3 * $i + 1} != $LocalBlock{3 * $i + 1} ||
                $GlobalBlock{3 * $i + 2} != $LocalBlock{3 * $i + 2}
            ) {
                return (0);
            }
        }
        return (1);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFWord...
    ::
     */
    public function GIFWord($int)
    {
        return (chr($int & 0xFF) . chr(($int >> 8) & 0xFF));
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GetAnimation...
    ::
     */
    public function GetAnimation()
    {
        return ($this->GIF);
    }
}

/*
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::
::  GIFDecoder Version 2.0 by László Zsidi
::  Optimized version by xurei
::
::  Created at 2007. 02. 01. '07.47.AM'
::
::  Updated at 2009. 06. 23. '06.00.AM'
::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

class GIFDecoder
{
    public $GIF_TransparentR = -1;
    public $GIF_TransparentG = -1;
    public $GIF_TransparentB = -1;
    public $GIF_TransparentI = 0;
    public $GIF_buffer       = null;
    public $GIF_arrays       = [];
    public $GIF_delays       = [];
    public $GIF_dispos       = [];
    public $GIF_stream       = "";
    public $GIF_string       = "";
    public $GIF_bfseek       = 0;
    public $GIF_anloop       = 0;

    //xurei - frames metadata
    public $GIF_frames_meta = [];
    public $GIF_screen      = [];
    public $GIF_global      = []; //global color map
    public $GIF_sorted;
    public $GIF_colorS; //
    public $GIF_colorC; //Size of global color table
    public $GIF_colorF; //if 1, global color table follows image descriptor
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFDecoder ( $GIF_pointer )
    ::
     */
    public function __construct($GIF_pointer)
    {
        $this->GIF_stream = $GIF_pointer;
        GIFDecoder::GIFGetByte(6);
        GIFDecoder::GIFGetByte(7);
        $this->GIF_screen = $this->GIF_buffer;
        $this->GIF_colorF = $this->GIF_buffer[4] & 0x80 ? 1 : 0;
        $this->GIF_sorted = $this->GIF_buffer[4] & 0x08 ? 1 : 0;
        $this->GIF_colorC = $this->GIF_buffer[4] & 0x07;
        $this->GIF_colorS = 2 << $this->GIF_colorC;
        if ($this->GIF_colorF == 1) {
            GIFDecoder::GIFGetByte(3 * $this->GIF_colorS);
            $this->GIF_global = $this->GIF_buffer;
        }
        for ($cycle = 1; $cycle;) {
            if (GIFDecoder::GIFGetByte(1)) {
                switch ($this->GIF_buffer[0]) {
                    case 0x21:
                        GIFDecoder::GIFReadExtensions();
                        break;
                    case 0x2C:
                        GIFDecoder::GIFReadDescriptor();
                        break;
                    case 0x3B:
                        $cycle = 0;
                        break;
                }
            } else {
                $cycle = 0;
            }
        }
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFReadExtension ( )
    ::
     */
    public function GIFReadExtensions()
    {
        GIFDecoder::GIFGetByte(1);
        if ($this->GIF_buffer[0] == 0xff) {
            for (;;) {
                GIFDecoder::GIFGetByte(1);
                if (($u = $this->GIF_buffer[0]) == 0x00) {
                    break;
                }
                GIFDecoder::GIFGetByte($u);
                if ($u == 0x03) {
                    $this->GIF_anloop = ($this->GIF_buffer[1] | $this->GIF_buffer[2] << 8);
                }
            }
        } else {
            for (;;) {
                GIFDecoder::GIFGetByte(1);
                if (($u = $this->GIF_buffer[0]) == 0x00) {
                    break;
                }
                GIFDecoder::GIFGetByte($u);
                if ($u == 0x04) {
                    $buf4 = count($this->GIF_buffer) >= 5 ? $this->GIF_buffer[4] : 0;
                    if ($buf4 & 0x80) {
                        $this->GIF_dispos[] = ($this->GIF_buffer[0] >> 2) - 1;
                    } else {
                        $this->GIF_dispos[] = ($this->GIF_buffer[0] >> 2) - 0;
                    }
                    $this->GIF_delays[] = ($this->GIF_buffer[1] | $this->GIF_buffer[2] << 8);
                    if ($this->GIF_buffer[3]) {
                        $this->GIF_TransparentI = $this->GIF_buffer[3];
                    }
                }
            }
        }
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFReadDescriptor ( )
    ::
     */
    public function GIFReadDescriptor()
    {
        $GIF_screen = [];
        GIFDecoder::GIFGetByte(9);

        //xurei - metadata saving
        $this->GIF_frames_meta[] = array(
            'left'   => $this->GIF_buffer[0] + ($this->GIF_buffer[1] << 8),
            'top'    => $this->GIF_buffer[2] + ($this->GIF_buffer[3] << 8),
            'width'  => $this->GIF_buffer[4] + ($this->GIF_buffer[5] << 8),
            'height' => $this->GIF_buffer[6] + ($this->GIF_buffer[7] << 8),
        );

        $GIF_screen = $this->GIF_buffer;
        $GIF_colorF = $this->GIF_buffer[8] & 0x80 ? 1 : 0;
        if ($GIF_colorF) {
            $GIF_code = $this->GIF_buffer[8] & 0x07;
            $GIF_sort = $this->GIF_buffer[8] & 0x20 ? 1 : 0;
        } else {
            $GIF_code = $this->GIF_colorC;
            $GIF_sort = $this->GIF_sorted;
        }
        $GIF_size = 2 << $GIF_code;
        $this->GIF_screen[4] &= 0x70;
        $this->GIF_screen[4] |= 0x80;
        $this->GIF_screen[4] |= $GIF_code;
        if ($GIF_sort) {
            $this->GIF_screen[4] |= 0x08;
        }

        /*
         *
         * GIF Data Begin
         *
         */
        if ($this->GIF_TransparentI) {
            $this->GIF_string = "GIF89a";
        } else {
            $this->GIF_string = "GIF87a";
        }
        GIFDecoder::GIFPutByte($this->GIF_screen);
        if ($GIF_colorF == 1) {
            GIFDecoder::GIFGetByte(3 * $GIF_size);
            if ($this->GIF_TransparentI) {
                $this->GIF_TransparentR = $this->GIF_buffer[3 * $this->GIF_TransparentI + 0];
                $this->GIF_TransparentG = $this->GIF_buffer[3 * $this->GIF_TransparentI + 1];
                $this->GIF_TransparentB = $this->GIF_buffer[3 * $this->GIF_TransparentI + 2];
            }
            GIFDecoder::GIFPutByte($this->GIF_buffer);
        } else {
            if ($this->GIF_TransparentI) {
                $this->GIF_TransparentR = $this->GIF_global[3 * $this->GIF_TransparentI + 0];
                $this->GIF_TransparentG = $this->GIF_global[3 * $this->GIF_TransparentI + 1];
                $this->GIF_TransparentB = $this->GIF_global[3 * $this->GIF_TransparentI + 2];
            }
            GIFDecoder::GIFPutByte($this->GIF_global);
        }
        if ($this->GIF_TransparentI) {
            $this->GIF_string .= "!\xF9\x04\x1\x0\x0" . chr($this->GIF_TransparentI) . "\x0";
        }
        $this->GIF_string .= chr(0x2C);
        $GIF_screen[8] &= 0x40;
        GIFDecoder::GIFPutByte($GIF_screen);
        GIFDecoder::GIFGetByte(1);
        GIFDecoder::GIFPutByte($this->GIF_buffer);
        for (;;) {
            GIFDecoder::GIFGetByte(1);
            GIFDecoder::GIFPutByte($this->GIF_buffer);
            if (($u = $this->GIF_buffer[0]) == 0x00) {
                break;
            }

            /*for ($i=0; $i!=$u; ++$i)
            {
            $this->GIF_string .= $this->GIF_stream { $this->GIF_bfseek++ };
            }*/
            $this->GIF_string .= substr($this->GIF_stream, $this->GIF_bfseek, $u);
            $this->GIF_bfseek += $u;

            //GIFDecoder::GIFGetByte ( $u );
            //GIFDecoder::GIFPutByte ( $this->GIF_buffer );
        }
        $this->GIF_string .= chr(0x3B);
        /*
         *
         * GIF Data End
         *
         */
        $this->GIF_arrays[] = $this->GIF_string;
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetByte ( $len )
    ::
     */
    // public function GIFGetByte($len)
    // {
    //     $this->GIF_buffer = new SplFixedArray($len);
    //     $l                = strlen($this->GIF_stream);
    //     for ($i = 0; $i < $len; $i++) {
    //         if ($this->GIF_bfseek > $l) {
    //             $this->GIF_buffer->setSize($i);
    //             return 0;
    //         }
    //         $this->GIF_buffer[$i] = ord($this->GIF_stream{$this->GIF_bfseek++});
    //     }
    //     return 1;
    // }
    private function GIFGetByte($len)
    {
        $this->GIF_buffer = [];

        for ($i = 0; $i < $len; $i++) {
            if ($this->GIF_bfseek > strlen($this->GIF_stream)) {
                return 0;
            }
            $this->GIF_buffer[] = ord($this->GIF_stream{$this->GIF_bfseek++});
        }
        return 1;
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFPutByte ( $bytes )
    ::
     */
    public function GIFPutByte($bytes)
    {
        $out = '';
        foreach ($bytes as $byte) {
            $out .= chr($byte);
        }
        $this->GIF_string .= $out;
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  PUBLIC FUNCTIONS
    ::
    ::
    ::  GIFGetFrames ( )
    ::
     */
    public function GIFGetFrames()
    {
        return ($this->GIF_arrays);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetFramesMeta ( )
    ::
    ::  xurei - returns metadata as an array of arrays
     */
    public function GIFGetFramesMeta()
    {
        return ($this->GIF_frames_meta);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetDelays ( )
    ::
     */
    public function GIFGetDelays()
    {
        return ($this->GIF_delays);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetLoop ( )
    ::
     */
    public function GIFGetLoop()
    {
        return ($this->GIF_anloop);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetDisposal ( )
    ::
     */
    public function GIFGetDisposal()
    {
        return ($this->GIF_dispos);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetTransparentR ( )
    ::
     */
    public function GIFGetTransparentR()
    {
        return ($this->GIF_TransparentR);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetTransparentG ( )
    ::
     */
    public function GIFGetTransparentG()
    {
        return ($this->GIF_TransparentG);
    }
    /*
    :::::::::::::::::::::::::::::::::::::::::::::::::::
    ::
    ::  GIFGetTransparentB ( )
    ::
     */
    public function GIFGetTransparentB()
    {
        return ($this->GIF_TransparentB);
    }
}