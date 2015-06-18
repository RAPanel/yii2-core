<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 22.04.2015
 * Time: 22:38
 */

namespace rere\core\widgets;


use yii\base\Widget;
use yii\helpers\Html;

class SearchForm extends Widget
{
    public function run()
    {
        $result = Html::beginForm(['site/search'], 'get');
        $result .= Html::input('text', 'q', null, ['autocomplete' => 'off', 'class' => 'inputSearch']);
        $result .= Html::button('', ['class' => 'inputSearchSubmit', 'type' => 'submit']);
        $result .= Html::endForm();
        return $result;
    }

}