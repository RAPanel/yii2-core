<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_user_auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string $provider_attributes
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $user
 */
class UserAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_user_auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'provider', 'provider_id', 'provider_attributes'], 'required'],
            [['user_id'], 'integer'],
            [['provider_attributes'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['provider', 'provider_id'], 'string', 'max' => 255]
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
            'provider' => Yii::t('rere', 'Provider'),
            'provider_id' => Yii::t('rere', 'Provider ID'),
            'provider_attributes' => Yii::t('rere', 'Provider Attributes'),
            'create_time' => Yii::t('rere', 'Create Time'),
            'update_time' => Yii::t('rere', 'Update Time'),
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
