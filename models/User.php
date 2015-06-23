<?php

namespace rere\core\models;

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
 * @property string $login_time
 * @property string $create_ip
 * @property string $created_time
 * @property string $updated_time
 * @property string $ban_time
 * @property string $ban_reason
 *
 * @property Page[] $pages
 * @property PageComments[] $pageComments
 * @property Photo[] $photos
 * @property UserRole $role
 * @property UserAuth[] $userAuths
 * @property UserKey[] $userKeys
 * @property UserProfile[] $userProfiles
 */
class User extends \rere\user\models\User
{


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'role_id' => Yii::t('rere.model', 'Role ID'),
            'status' => Yii::t('rere.model', 'Status'),
            'email' => Yii::t('rere.model', 'Email'),
            'new_email' => Yii::t('rere.model', 'New Email'),
            'username' => Yii::t('rere.model', 'Username'),
            'password' => Yii::t('rere.model', 'Password'),
            'auth_key' => Yii::t('rere.model', 'Auth Key'),
            'api_key' => Yii::t('rere.model', 'Api Key'),
            'login_ip' => Yii::t('rere.model', 'Login Ip'),
            'login_time' => Yii::t('rere.model', 'Login Time'),
            'create_ip' => Yii::t('rere.model', 'Create Ip'),
            'created_time' => Yii::t('rere.model', 'Created Time'),
            'updated_time' => Yii::t('rere.model', 'Updated Time'),
            'ban_time' => Yii::t('rere.model', 'Ban Time'),
            'ban_reason' => Yii::t('rere.model', 'Ban Reason'),
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
