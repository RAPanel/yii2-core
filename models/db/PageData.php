<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_data}}".
 *
 * @property integer $page_id
 * @property string $header
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
            [['page_id'], 'required'],
            [['page_id'], 'integer'],
            [['content', 'tags'], 'string'],
            [['header', 'title', 'description', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'header' => Yii::t('app', 'Header'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'content' => Yii::t('app', 'Content'),
            'tags' => Yii::t('app', 'Tags'),
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
