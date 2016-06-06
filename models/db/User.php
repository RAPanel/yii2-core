<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $status
 * @property string $email
 * @property string $new_email
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $api_key
 * @property string $login_ip
 * @property string $create_ip
 * @property string $ban_reason
 * @property string $login_time
 * @property string $ban_time
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Page[] $pages
 * @property PageComments[] $pageComments
 * @property UserRole $role
 * @property UserAuth[] $userAuths
 * @property UserKey[] $userKeys
 * @property UserProfile[] $userProfiles
 * @property UserRemember[] $userRemembers
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'email'], 'required'],
            [['role_id', 'status'], 'integer'],
            [['login_time', 'ban_time', 'created_at', 'updated_at'], 'safe'],
            [['email', 'new_email', 'username', 'password', 'auth_key', 'api_key', 'login_ip', 'create_ip', 'ban_reason'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role_id' => Yii::t('app', 'Role ID'),
            'status' => Yii::t('app', 'Status'),
            'email' => Yii::t('app', 'Email'),
            'new_email' => Yii::t('app', 'New Email'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'api_key' => Yii::t('app', 'Api Key'),
            'login_ip' => Yii::t('app', 'Login Ip'),
            'create_ip' => Yii::t('app', 'Create Ip'),
            'ban_reason' => Yii::t('app', 'Ban Reason'),
            'login_time' => Yii::t('app', 'Login Time'),
            'ban_time' => Yii::t('app', 'Ban Time'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageComments()
    {
        return $this->hasMany(PageComments::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuths()
    {
        return $this->hasMany(UserAuth::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserKeys()
    {
        return $this->hasMany(UserKey::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRemembers()
    {
        return $this->hasMany(UserRemember::className(), ['user_id' => 'id']);
    }
}
