<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_remember}}".
 *
 * @property integer $user_id
 * @property string $key
 * @property string $value
 *
 * @property User $user
 */
class UserRemember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_remember}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['key'], 'string', 'max' => 32],
            [['value'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
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
