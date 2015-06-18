<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_profile".
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
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_profile';
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
            'id' => Yii::t('rere', 'ID'),
            'user_id' => Yii::t('rere', 'User ID'),
            'create_time' => Yii::t('rere', 'Create Time'),
            'update_time' => Yii::t('rere', 'Update Time'),
            'full_name' => Yii::t('rere', 'Full Name'),
            'city' => Yii::t('rere', 'City'),
            'vk' => Yii::t('rere', 'Vk'),
            'fb' => Yii::t('rere', 'Fb'),
            'ig' => Yii::t('rere', 'Ig'),
            'tw' => Yii::t('rere', 'Tw'),
            'options' => Yii::t('rere', 'Options'),
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
