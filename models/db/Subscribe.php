<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%subscribe}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property resource $data
 * @property string $created_at
 * @property string $updated_at
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscribe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
