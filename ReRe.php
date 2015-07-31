<?php

namespace rere\core;

use rere\core\models\Module;
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
        $base = Module::all();
        return is_numeric($q) || isset($base[$q]) ? $base[$q] : array_search($q, $base);
    }

}