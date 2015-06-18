<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%replaces}}".
 *
 * @property string $name
 * @property string $value
 * @property string $update_at
 */
class Replaces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%replaces}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['value'], 'string'],
            [['update_at'], 'safe'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('rere', 'Name'),
            'value' => Yii::t('rere', 'Value'),
            'update_at' => Yii::t('rere', 'Update At'),
        ];
    }
}
