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

class PageController extends \rere\core\controllers\Controller
{
    public function actionIndex($url = null)
    {
        $base = $this->page($url ? compact('url') : ['url' => "/$this->id"]);
        return $this->render($this->action->id, compact('base'));
    }

    public function actionShow($url)
    {
        $base = $this->page(compact('url'));
        return $this->render($this->action->id, compact('base'));
    }

    public function page($condition)
    {
        $page = Page::find()->where($condition)->one();
        if (!$condition) throw new HttpException(404, Yii::t('rere.error', 'Can`t find page'));
        return $page;
    }

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