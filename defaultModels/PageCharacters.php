<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%page_characters}}".
 *
 * @property string $page_id
 * @property string $name
 * @property string $value
 *
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
            [['page_id', 'name', 'value'], 'required'],
            [['page_id'], 'integer'],
            [['value'], 'string'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('rere', 'Page ID'),
            'name' => Yii::t('rere', 'Name'),
            'value' => Yii::t('rere', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
