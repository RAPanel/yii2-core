<?php

namespace rere\core\widgets;

use Yii;
use yii\web\AssetBundle;

class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@bower/slick-carousel';

    public $depends = [
        '\yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();

        $this->js = [
            'jquery.slimscroll' . (YII_DEBUG ? '' : '.min') . '.js'
        ];
    }
}
