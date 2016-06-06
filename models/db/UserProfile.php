<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $full_name
 * @property string $city
 * @property string $vk
 * @property string $fb
 * @property string $ig
 * @property string $tw
 * @property string $options
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'city', 'vk', 'fb', 'ig', 'tw', 'options'], 'string', 'max' => 255]
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
            'full_name' => Yii::t('app', 'Full Name'),
            'city' => Yii::t('app', 'City'),
            'vk' => Yii::t('app', 'Vk'),
            'fb' => Yii::t('app', 'Fb'),
            'ig' => Yii::t('app', 'Ig'),
            'tw' => Yii::t('app', 'Tw'),
            'options' => Yii::t('app', 'Options'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
