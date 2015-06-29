<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 23.06.2015
 * Time: 14:42
 */

namespace rere\core\models;


class PageMenu extends Page
{

    public function getLabel()
    {
        return $this->name;
    }

    public function getActive()
    {
        return $this->getHref() == \Yii::$app->request->pathInfo;
    }

}