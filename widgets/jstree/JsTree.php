<?php
/**
 */

namespace rere\core\widgets\jstree;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class JsTree extends Widget
{
    public $options = [];
    public $clientOptions = [];
    public $containerTag = 'div';

    /**
     * @var boolean|string $theme
     * Set to false to use a custom theme and then set clientOptions['core']['themes'] with theme information.
     * Set to 'default' or 'default-dark' to use one the bundled themes.
     * @see http://www.jstree.com/api/#/?f=$.jstree.defaults.core.themes
     */
    public $theme = 'default';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->options['id']))
            $this->options['id'] = $this->getId();

        $asset = JsTreeAsset::register($this->getView());
        $asset->theme = $this->theme;

        if ($this->theme !== false && !isset($this->clientOptions['core']['themes'])) {
            $this->clientOptions['core']['themes'] = [
                'name' => $this->theme,
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerPlugin();
        return Html::tag($this->containerTag, '', $this->options);
    }

    /**
     * Registers a specific Bootstrap plugin and the related events
     * @param string $name the name of the Bootstrap plugin
     */
    protected function registerPlugin()
    {
        $id = $this->options['id'];

        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
            $js = "jQuery('#{$id}').jstree({$options});";
            $this->getView()->registerJs($js);
        }
    }
}

