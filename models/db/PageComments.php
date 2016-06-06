<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_comments}}".
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $user_id
 * @property integer $parent_id
 * @property integer $rating
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Page $page
 * @property PageComments $parent
 * @property PageComments[] $pageComments
 * @property User $user
 */
class PageComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'user_id', 'text'], 'required'],
            [['page_id', 'user_id', 'parent_id', 'rating'], 'integer'],
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe']
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
            'user_id' => Yii::t('app', 'User ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'rating' => Yii::t('app', 'Rating'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(PageComments::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageComments()
    {
        return $this->hasMany(PageComments::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
