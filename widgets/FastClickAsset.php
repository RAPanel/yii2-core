<?php

namespace rere\core\widgets;

use Yii;
use yii\web\AssetBundle;

class FastClickAsset extends AssetBundle
{
    public $sourcePath = '@bower/fastclick/lib';

    public $js = [
        'fastclick.js'
    ];
}
