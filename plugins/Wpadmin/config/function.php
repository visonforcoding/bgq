<?php

/**
 * Encoding     :   UTF-8
 * Created on   :   2015-12-26 22:45:09 by allen <blog.rc5j.cn> , caowenpeng1990@126.com
 */

function getMessage($errors) {
    foreach ($errors as $value) {
        foreach ($value as $val) {
            $error = $val;
            break;
        }
    }
    return $error;
}
