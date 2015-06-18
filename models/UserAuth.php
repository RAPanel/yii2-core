<?php

namespace rere\core\models;

use Yii;

/**
 * This is the model class for table "{{%user_auth}}".
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
        return '{{%user_auth}}';
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
            'id' => Yii::t('rere.model', 'ID'),
            'user_id' => Yii::t('rere.model', 'User ID'),
            'provider' => Yii::t('rere.model', 'Provider'),
            'provider_id' => Yii::t('rere.model', 'Provider ID'),
            'provider_attributes' => Yii::t('rere.model', 'Provider Attributes'),
            'create_time' => Yii::t('rere.model', 'Create Time'),
            'update_time' => Yii::t('rere.model', 'Update Time'),
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
