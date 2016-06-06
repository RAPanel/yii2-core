<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%message_translate}}".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * @property Message $id0
 */
class MessageTranslate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_translate}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language' => Yii::t('app', 'Language'),
            'translation' => Yii::t('app', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Message::className(), ['id' => 'id']);
    }
}
