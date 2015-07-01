<?php

namespace rere\core\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%character}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $type
 */
class Character extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%character}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'type'], 'required'],
            [['url'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'url' => Yii::t('rere.model', 'Url'),
            'type' => Yii::t('rere.model', 'Type'),
        ];
    }



    public static function all()
    {
        return self::find()->all();
    }

    public static function typeMap()
    {
        return ArrayHelper::map(self::all(), 'url', 'type');
    }

    public function field($value = null, $options = [])
    {
        return Html::hiddenInput('PageCharacters[' . $this->id . '][name]', $this->url, $options) . Html::input($this->type, 'PageCharacters[' . $this->id . '][value]', $value, $options);
    }
}
