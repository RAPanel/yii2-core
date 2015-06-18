<?php

namespace rere\core;

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
    public static function module($q)
    {
        $base = Yii::$app->params['modules'];
        return is_numeric($q) || isset($base[$q]) ? $base[$q] : array_search($q, $base);
    }

    public static function purifyUrl($url)
    {
        $url = Html::decode(mb_strtolower(trim($url)));
        $url = str_replace("//", "/", $url);
        $url = preg_replace("#[\s\,\/]+#", "-", $url);
        $url = preg_replace('#[^0-9a-z-]#', '', $url);
        return $url;
    }

}