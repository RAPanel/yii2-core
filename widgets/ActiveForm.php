<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 24.03.2015
 * Time: 15:49
 */

namespace rere\core\widgets;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

class ActiveForm extends \yii\widgets\ActiveForm
{
    /**
     * @param $type
     * @param $model \yii\base\Model
     * @param $attribute
     * @param $options
     * @return static the field object itself
     */
    public function input($type, $model, $attribute, $options = [])
    {
        return $this->field($model, $attribute)
            ->input($type, ArrayHelper::merge([
                'placeholder' => $model->getAttributeLabel($attribute),
                'required' => $model->isAttributeRequired($attribute)
            ], $options));
    }

    /**
     * @param array $items
     * @param ActiveRecord $model
     * @param string $attribute
     * @param array $options
     * @return ActiveField
     */
    public function select($items, $model, $attribute, $options = [])
    {
        return $this->field($model, $attribute)
            ->dropDownList($items, ArrayHelper::merge([
                'empty' => $model->getAttributeLabel($attribute),
                'required' => $model->isAttributeRequired($attribute)
            ], $options));
    }

    /**
     * @param $type
     * @param $model \yii\base\Model
     * @param $attribute
     * @param $options
     * @return static the field object itself
     */
    public function textArea($size, $model, $attribute, $options = [])
    {
        return $this->field($model, $attribute)
            ->textArea(ArrayHelper::merge([
                'rows' => $size,
                'placeholder' => $model->getAttributeLabel($attribute),
                'required' => $model->isAttributeRequired($attribute)
            ], $options));
    }
}