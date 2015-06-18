<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_page_comments".
 *
 * @property string $id
 * @property string $page_id
 * @property integer $user_id
 * @property string $parent_id
 * @property integer $rating
 * @property string $text
 * @property string $created
 *
 * @property Page $page
 * @property User $user
 */
class PageComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_page_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'user_id', 'parent_id', 'rating'], 'required'],
            [['page_id', 'user_id', 'parent_id', 'rating'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'page_id' => Yii::t('rere', 'Page ID'),
            'user_id' => Yii::t('rere', 'User ID'),
            'parent_id' => Yii::t('rere', 'Parent ID'),
            'rating' => Yii::t('rere', 'Rating'),
            'text' => Yii::t('rere', 'Text'),
            'created' => Yii::t('rere', 'Created'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
