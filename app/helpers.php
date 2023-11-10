<?php

/**
* 独自helperファイル
*/

/**
* 文字列内のimgタグを除去する
*
* @param [type] $value
* @return void
*/
if (!function_exists('removalImageTag')) {
    function removalImageTag($value)
    {
        return preg_replace("/<img(.+?)>/", "", $value);
    }
}
