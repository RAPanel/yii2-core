<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_user_remember".
 *
 * @property string $user_id
 * @property string $key
 * @property string $value
 */
class UserRemember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_user_remember';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'key', 'value'], 'required'],
            [['user_id'], 'integer'],
            [['key'], 'string', 'max' => 32],
            [['value'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('rere', 'User ID'),
            'key' => Yii::t('rere', 'Key'),
            'value' => Yii::t('rere', 'Value'),
        ];
    }
}
