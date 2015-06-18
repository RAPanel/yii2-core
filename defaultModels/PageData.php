<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%page_data}}".
 *
 * @property string $page_id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property string $tags
 *
 * @property Page $page
 */
class PageData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'title', 'description', 'keywords', 'content', 'tags'], 'required'],
            [['page_id'], 'integer'],
            [['content', 'tags'], 'string'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('rere', 'Page ID'),
            'title' => Yii::t('rere', 'Title'),
            'description' => Yii::t('rere', 'Description'),
            'keywords' => Yii::t('rere', 'Keywords'),
            'content' => Yii::t('rere', 'Content'),
            'tags' => Yii::t('rere', 'Tags'),
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
