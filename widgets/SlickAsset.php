<?php

namespace rere\core\widgets;

use Yii;
use yii\web\AssetBundle;

class SlickAsset extends AssetBundle
{
    public $sourcePath = '@bower/slick-carousel/slick';

    public $css = [
        'slick.css',
    ];

    public $depends = [
        '\yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();

        $this->js = [
            'slick' . (YII_DEBUG ? '' : '.min') . '.js'
        ];
    }
}