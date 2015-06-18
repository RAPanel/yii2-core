<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_user".
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
 * @property string $login_time
 * @property string $create_ip
 * @property string $create_time
 * @property string $update_time
 * @property string $ban_time
 * @property string $ban_reason
 *
 * @property Page[] $pages
 * @property PageComments[] $pageComments
 * @property Photo[] $photos
 * @property Profile[] $profiles
 * @property Role $role
 * @property UserAuth[] $userAuths
 * @property UserKey[] $userKeys
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'status'], 'required'],
            [['role_id', 'status'], 'integer'],
            [['login_time', 'create_time', 'update_time', 'ban_time'], 'safe'],
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
            'id' => Yii::t('rere', 'ID'),
            'role_id' => Yii::t('rere', 'Role ID'),
            'status' => Yii::t('rere', 'Status'),
            'email' => Yii::t('rere', 'Email'),
            'new_email' => Yii::t('rere', 'New Email'),
            'username' => Yii::t('rere', 'Username'),
            'password' => Yii::t('rere', 'Password'),
            'auth_key' => Yii::t('rere', 'Auth Key'),
            'api_key' => Yii::t('rere', 'Api Key'),
            'login_ip' => Yii::t('rere', 'Login Ip'),
            'login_time' => Yii::t('rere', 'Login Time'),
            'create_ip' => Yii::t('rere', 'Create Ip'),
            'create_time' => Yii::t('rere', 'Create Time'),
            'update_time' => Yii::t('rere', 'Update Time'),
            'ban_time' => Yii::t('rere', 'Ban Time'),
            'ban_reason' => Yii::t('rere', 'Ban Reason'),
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
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
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
}
