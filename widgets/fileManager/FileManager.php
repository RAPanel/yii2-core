<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 22.04.2015
 * Time: 22:38
 */

namespace rere\core\widgets\fileManager;


use yii\base\Widget;

class FileManager extends Widget
{
    public function run()
    {
        $data = FileManagerAsset::register($this->view);
        var_dump($data);
    }

}