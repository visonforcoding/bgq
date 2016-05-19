<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2015-12-26 22:45:09 by allen <blog.rc5j.cn> , caowenpeng1990@126.com
 */

/**
 * 生成指定长度的随机字符串
 * @param type $length
 * @param int $type 默认1数字字母混合，2纯数字，3纯字母
 * @return string
 */
function createRandomCode($length, $type = 1) {
    $randomCode = "";
    switch ($type) {
        case 1:
            $randomChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 2:
            $randomChars = '0123456789';
            break;
        case 3:
            $randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        default:
            break;
    }
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $randomChars { mt_rand(0, strlen($randomChars) - 1) };
    }
    return $randomCode;
}