<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_user_key".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property string $key
 * @property string $create_time
 * @property string $consume_time
 * @property string $expire_time
 *
 * @property User $user
 */
class UserKey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_user_key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'key'], 'required'],
            [['user_id', 'type'], 'integer'],
            [['create_time', 'consume_time', 'expire_time'], 'safe'],
            [['key'], 'string', 'max' => 255],
            [['key'], 'unique']
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
            'type' => Yii::t('rere', 'Type'),
            'key' => Yii::t('rere', 'Key'),
            'create_time' => Yii::t('rere', 'Create Time'),
            'consume_time' => Yii::t('rere', 'Consume Time'),
            'expire_time' => Yii::t('rere', 'Expire Time'),
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
