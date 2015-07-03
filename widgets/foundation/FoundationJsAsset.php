<?php

namespace rere\core\widgets\foundation;

use Yii;
use yii\web\AssetBundle;

class FoundationJsAsset extends AssetBundle
{
    public $sourcePath = '@bower/foundation';
    public $initializeScript = false;

    public $css = [];

    public $depends = [
        '\yii\web\JqueryAsset',
        'rere\core\widgets\ModernizrAsset',
    ];

    public function init()
    {
        parent::init();

        if ($this->initializeScript)
            Yii::$app->view->registerJs('$(document).foundation();');

        $this->js = [
            'js/foundation' . (YII_DEBUG ? '' : '.min') . '.js'
        ];
    }
}