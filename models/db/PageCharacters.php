<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_characters}}".
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $character_id
 * @property integer $sort
 * @property integer $value
 *
 * @property Character $character
 * @property Page $page
 */
class PageCharacters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_characters}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'character_id'], 'required'],
            [['page_id', 'character_id', 'sort', 'value'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'page_id' => Yii::t('app', 'Page ID'),
            'character_id' => Yii::t('app', 'Character ID'),
            'sort' => Yii::t('app', 'Sort'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
