<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_key}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property string $key_value
 * @property string $expire_at
 * @property string $created_at
 *
 * @property User $user
 */
class UserKey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_key}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'type'], 'integer'],
            [['expire_at', 'created_at'], 'safe'],
            [['key_value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'type' => Yii::t('app', 'Type'),
            'key_value' => Yii::t('app', 'Key Value'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
