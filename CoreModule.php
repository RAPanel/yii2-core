<?php
namespace ra;

use Yii;

/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 02.09.2015
 * Time: 16:24
 */
class CoreModule extends \yii\base\Module
{
    public $settings;

    public function init()
    {
        // импорт всех файлов конфигураций
        Yii::$app->ra->configure($this->module, 'admin');

        parent::init();
    }
}