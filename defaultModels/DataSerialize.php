<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%data_serialize}}".
 *
 * @property string $id
 * @property string $type
 * @property resource $value
 */
class DataSerialize extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%data_serialize}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['value'], 'string'],
            [['type'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'type' => Yii::t('rere', 'Type'),
            'value' => Yii::t('rere', 'Value'),
        ];
    }
}