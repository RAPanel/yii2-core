<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property integer $with_child
 * @property string $sort_id
 * @property integer $user_id
 * @property integer $status_id
 * @property string $parent_id
 * @property string $module_id
 * @property string $parent_list
 * @property string $url
 * @property string $name
 * @property string $about
 * @property string $created
 * @property string $lastmod
 *
 * @property Page $parent
 * @property Page[] $pages
 * @property User $user
 * @property PageCharacters[] $pageCharacters
 * @property PageComments[] $pageComments
 * @property PageData $pageData
 * @property Photo[] $photos
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['with_child', 'sort_id', 'user_id', 'status_id', 'module_id', 'parent_list', 'url', 'name', 'about', 'created'], 'required'],
            [['with_child', 'sort_id', 'user_id', 'status_id', 'parent_id', 'module_id'], 'integer'],
            [['created', 'lastmod'], 'safe'],
            [['parent_list', 'url', 'name', 'about'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'with_child' => Yii::t('rere', 'With Child'),
            'sort_id' => Yii::t('rere', 'Sort ID'),
            'user_id' => Yii::t('rere', 'User ID'),
            'status_id' => Yii::t('rere', 'Status ID'),
            'parent_id' => Yii::t('rere', 'Parent ID'),
            'module_id' => Yii::t('rere', 'Module ID'),
            'parent_list' => Yii::t('rere', 'Parent List'),
            'url' => Yii::t('rere', 'Url'),
            'name' => Yii::t('rere', 'Name'),
            'about' => Yii::t('rere', 'About'),
            'created' => Yii::t('rere', 'Created'),
            'lastmod' => Yii::t('rere', 'Lastmod'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageCharacters()
    {
        return $this->hasMany(PageCharacters::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageComments()
    {
        return $this->hasMany(PageComments::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageData()
    {
        return $this->hasOne(PageData::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['page_id' => 'id']);
    }
}
