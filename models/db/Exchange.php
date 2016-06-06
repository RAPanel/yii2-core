<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%exchange}}".
 *
 * @property string $id
 * @property string $type
 * @property integer $value
 */
class Exchange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%exchange}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'value'], 'required'],
            [['value'], 'integer'],
            [['id'], 'string', 'max' => 36],
            [['type'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
