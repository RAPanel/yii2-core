<?php

namespace ra\models;

use Yii;

/**
 * This is the model class for table "{{%sql}}".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 */
class Sql extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sql}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['value'], 'string'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ra', 'ID'),
            'name' => Yii::t('ra', 'Name'),
            'value' => Yii::t('ra', 'Value'),
        ];
    }
}
