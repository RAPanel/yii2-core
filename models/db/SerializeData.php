<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%serialize_data}}".
 *
 * @property integer $id
 * @property resource $value
 */
class SerializeData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%serialize_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
