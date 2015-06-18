<?php

namespace rere\core\widgets\foundation;

use Yii;
use yii\web\AssetBundle;

class FoundationAsset extends AssetBundle
{
    public $sourcePath = '@bower/foundation';
    public $initializeScript = true;

    public $css = [
        'css/normalize.css',
        'css/foundation.css'
    ];

    public $depends = [
        '\yii\web\JqueryAsset',
        'rere\core\widgets\FastClickAsset',
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
