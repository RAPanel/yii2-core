<?php

namespace rere\core;

use Yii;

/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 10.04.2015
 * Time: 13:47
 */
class ReRe
{
    public static function module($q)
    {
        $base = Yii::$app->params['modules'];
        return is_numeric($q) || isset($base[$q]) ? $base[$q] : array_search($q, $base);
    }

}