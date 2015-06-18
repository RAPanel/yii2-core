<?php
/**
 */

namespace rere\core\widgets\jstree;

use yii\web\AssetBundle;

class JsTreeAsset extends AssetBundle
{
    /** @var string */
    public $theme = 'default';

    public $sourcePath = '@bower/jstree/dist';
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        $min = YII_DEBUG;
        $this->js[] = $min ? 'jstree.min.js' : 'jstree.js';
        if ($this->theme) {
            $cssFile = $min ? 'style.min.css' : 'style.css';
            $this->css[] = "themes/{$this->theme}/{$cssFile}";
        }

        parent::registerAssetFiles($view);
    }
}