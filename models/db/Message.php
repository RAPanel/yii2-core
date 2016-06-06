<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property MessageTranslate[] $messageTranslates
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'message'], 'required'],
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageTranslates()
    {
        return $this->hasMany(MessageTranslate::className(), ['id' => 'id']);
    }
}
