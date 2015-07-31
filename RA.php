<?php

namespace rere\core;

use rere\core\models\Module;
use Yii;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 10.04.2015
 * Time: 13:47
 */
class RA
{
    public static function module($q = null)
    {
        $base = Module::all();
        return is_null($q) ? $base : (is_numeric($q) && isset($base[$q]) ? $base[$q] : array_search($q, $base));
    }

    public static function purifyUrl($url, $allowSlash = false)
    {
        $url = Html::decode(mb_strtolower(trim($url)));
//        $url = str_replace("//", "/", $url);
        $url = preg_replace('#[\s\,' . ($allowSlash ? '' : '\/') . ']+#', "-", $url);
        $url = preg_replace('#[^0-9a-z-' . ($allowSlash ? '\/' : '') . ']#', '', $url);
        return trim($url, '-');
    }

}