<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 18.06.2015
 * Time: 18:36
 */

namespace rere\core\models;


class Role extends \amnah\yii2\user\models\Role
{
    public static function tableName()
    {
        return '{{%user_role}}';
    }
}