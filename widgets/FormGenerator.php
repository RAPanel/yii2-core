<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 09.04.2015
 * Time: 14:18
 */

namespace rere\core\widgets;

use yii\helpers\Html;
use yii\widgets\Menu;

class FormGenerator extends \yii\base\Widget
{

    /**
     * @var $form \yii\widgets\ActiveForm
     */
    public $form;
    public $model;
    public $config;

    /**
     * @return string
     */
    public function run()
    {
        $result = '';

        $items = [];
        foreach (array_keys($this->config) as $val)
            $items[] = [
                'label' => \Yii::t('rere.admin', $val),
                'url' => '#' . strtolower($val),
                'active' => empty($items)
            ];

        $result .= Menu::widget([
            'items' => $items,
            'itemOptions' => [
                'class' => 'tab-title',
            ],
            'options' => [
                'class' => 'tabs',
                'data-tab' => true,
            ]
        ]);

        $classList = [];
        $result .= Html::beginTag('div', ['class' => 'tabs-content row']);
        foreach ($this->config as $tab => $value) {
            $result .= Html::beginTag('div', ['class' => 'content' . (current($this->config) == $value ? ' active' : ''), 'id' => strtolower($tab)]);
            foreach ($value as $name => $settings) {
                $type = strtolower($settings['type']);
                $options = isset($settings['options']) ? $settings['options'] : [];
                if (!$type) continue;

                /** @var \yii\db\ActiveRecord $model */
                $model = $this->model;
                $attributes = explode('.', $name);
                foreach ($attributes as $attribute) if ($attribute)
                    if ($attribute != end($attributes)) {
                        if ($model->{$attribute})
                            $model = $model->{$attribute};
                        else {
                            $method = 'get' . ucfirst($attribute);
                            $data = $model->{$method}();
                            $model = new $data->modelClass;
                        }
                    }
                if (empty($attribute)) continue;
                $classList[$model->formName()] = $model::className();

                $field = $this->form->field($model, $attribute);
                if (empty($settings['tagOptions']['class'])) $settings['tagOptions']['class'] = 'column';
                $field->options = $settings['tagOptions'];
                if ($type == 'widget')
                    $result .= $field->widget($settings['widget'], $options);
                elseif ($type == 'select' || $type == 'dropDownList')
                    $result .= $field->dropDownList($settings['items'], $options);
                elseif (method_exists($field, $type))
                    $result .= $field->{$type}($options);
                else
                    $result .= $field->input($type, $options);
            }
            $result .= Html::tag('div', '', ['class' => 'clearfix']);
            $result .= Html::endTag('div');
        }
        $result .= Html::endTag('div');

        $result .= Html::hiddenInput('modelsList', serialize($classList));

        return $result;
    }

}