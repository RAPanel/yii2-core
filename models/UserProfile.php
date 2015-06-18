<?php

namespace rere\core\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 * @property string $full_name
 * @property string $city
 * @property string $vk
 * @property string $fb
 * @property string $ig
 * @property string $tw
 * @property string $options
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
            [['create_time', 'update_time'], 'safe'],
            [['full_name'], 'string', 'max' => 255],
            [['city', 'vk', 'fb', 'ig', 'tw', 'options'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'user_id' => Yii::t('rere.model', 'User ID'),
            'create_time' => Yii::t('rere.model', 'Create Time'),
            'update_time' => Yii::t('rere.model', 'Update Time'),
            'full_name' => Yii::t('rere.model', 'Full Name'),
            'city' => Yii::t('rere.model', 'City'),
            'vk' => Yii::t('rere.model', 'Vk'),
            'fb' => Yii::t('rere.model', 'Fb'),
            'ig' => Yii::t('rere.model', 'Ig'),
            'tw' => Yii::t('rere.model', 'Tw'),
            'options' => Yii::t('rere.model', 'Options'),
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
