<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_counts}}".
 *
 * @property integer $page_id
 * @property integer $views
 * @property integer $likes
 * @property integer $comments
 *
 * @property Page $page
 */
class PageCounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_counts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'required'],
            [['page_id', 'views', 'likes', 'comments'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'views' => Yii::t('app', 'Views'),
            'likes' => Yii::t('app', 'Likes'),
            'comments' => Yii::t('app', 'Comments'),
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
