<?php

namespace rere\core\models;

use Yii;

/**
 * This is the model class for table "{{%user_role}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_time
 * @property string $update_time
 * @property integer $can_admin
 *
 * @property User[] $users
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['can_admin'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'name' => Yii::t('rere.model', 'Name'),
            'create_time' => Yii::t('rere.model', 'Create Time'),
            'update_time' => Yii::t('rere.model', 'Update Time'),
            'can_admin' => Yii::t('rere.model', 'Can Admin'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }
}
