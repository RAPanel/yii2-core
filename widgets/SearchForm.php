<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 22.04.2015
 * Time: 22:38
 */

namespace rere\core\widgets;


use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class SearchForm extends Widget
{
    public $formOptions = [];
    public $inputOptions = [];
    public function run()
    {
        $result = Html::beginForm(['site/search'], 'get', $this->formOptions);
        $result .= Html::input('text', 'q', null, ArrayHelper::merge(['autocomplete' => 'off', 'class' => 'inputSearch'], $this->inputOptions));
        $result .= Html::button('', ['class' => 'inputSearchSubmit', 'type' => 'submit']);
        $result .= Html::endForm();
        return $result;
    }

}