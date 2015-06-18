<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%session}}".
 *
 * @property string $id
 * @property integer $expire
 * @property resource $data
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%session}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'expire' => Yii::t('rere', 'Expire'),
            'data' => Yii::t('rere', 'Data'),
        ];
    }
}
