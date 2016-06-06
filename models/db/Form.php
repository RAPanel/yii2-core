<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%form}}".
 *
 * @property integer $id
 * @property string $type
 * @property resource $data
 * @property string $created_at
 * @property string $updated_at
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 32]
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
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
