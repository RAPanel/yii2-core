<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 09.04.2015
 * Time: 16:03
 */

namespace rere\core\widgets;


use yii\helpers\Html;
use yii\widgets\InputWidget;

class Characters extends InputWidget
{

    /**
     * @return string
     */
    public function run()
    {
        $result = '';

        foreach ($this->model->pageCharacters as $character)
            Html::textInput('Characters[' . $character->name . ']', $character->value);

        $result .= Html::button('добавить характеристику', ['data-reveal-id' => 'addCharacter']);

        $result .= Html::beginTag('div', ['id' => 'addCharacter', 'class' => 'reveal-modal', 'data-reveal' => 1]);
        $result .= Html::beginForm();
        /*$model = new Character();
        Html::activeInput('text', $model, 'url');
        <<<Html
<div class="row">
</div>
Html;*/

        $result .= Html::endForm();
        $result .= Html::a('&#215;', null, ['class' => "close-reveal-modal", 'aria-label' => "Close"]);
        $result .= Html::endTag('div');

        return $result;
    }
}