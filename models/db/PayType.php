<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%pay_type}}".
 *
 * @property integer $id
 * @property integer $sort
 * @property string $name
 * @property string $type
 * @property resource $data
 * @property string $created_at
 * @property string $updated_at
 */
class PayType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pay_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'sort' => Yii::t('app', 'Sort'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
