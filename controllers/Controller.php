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

class Controller extends \yii\web\Controller
{
    public function render($view, $params = [])
    {
        /** @var $base Page */
        if (isset($params['base']) && ($base = $params['base'])) {
            if (method_exists($base, 'getData') && ($data = $base->data)) {
                if (!empty($data['title'])) $this->getView()->title = $data['title'];
                if (!empty($data['description'])) $this->getView()->registerMetaTag(['name' => 'description', 'content' => $data['description']]);
                if (!empty($data['keywords'])) $this->getView()->registerMetaTag(['name' => 'keywords', 'content' => $data['keywords']]);
            }
        }
        return parent::render($view, $params);
    }

}