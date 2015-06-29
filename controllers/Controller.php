<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 28.05.2015
 * Time: 16:31
 */

namespace rere\core\controllers;


use rere\core\models\Page;
use Yii;
use yii\web\HttpException;

class Controller extends \yii\web\Controller
{
    public function render($view, $params = [])
    {
        $render = Yii::$app->request->isAjax ? 'renderAjax' : 'render';
        return parent::$render($view, $params);
    }

}