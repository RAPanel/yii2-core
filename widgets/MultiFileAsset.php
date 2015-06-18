<?php

namespace rere\core\widgets;

use Yii;
use yii\web\AssetBundle;

class MultiFileAsset extends AssetBundle
{
    public $sourcePath = '@bower/multifile';

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public $js = [
        'jQuery.MultiFile.min.js',
    ];
}
