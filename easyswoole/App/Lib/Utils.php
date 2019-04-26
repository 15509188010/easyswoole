<?php

namespace App\Lib;

/**
 * 通用工具类
 */
class Utils
{
    /**
     * 生成唯一性的key
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    public static function getFileKey($str)
    {
        return substr(self::makeRandomString() . $str . time() . rand(0, 9999), 8, 16);
    }

    /**
     * 生成随机字符串
     * @param  integer $length [description]
     * @return [type]          [description]
     */
    public static function makeRandomString($length = 1)
    {
        $str    = null;
        $strPol = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max    = strlen($strPol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)]; #生成介于0和max之间的随机整数
        }
        return $str;
    }
}
