<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $is_category
 * @property integer $status
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $parent_id
 * @property integer $module_id
 * @property integer $user_id
 * @property string $url
 * @property string $name
 * @property string $about
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Module $module
 * @property Page $parent
 * @property Page[] $pages
 * @property User $user
 * @property PageCharacters[] $pageCharacters
 * @property PageComments[] $pageComments
 * @property PageCounts[] $pageCounts
 * @property PageData[] $pageDatas
 * @property PageIndex[] $pageIndices
 * @property PagePrice[] $pagePrices
 * @property PageSessionData[] $pageSessionDatas
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
            [['is_category', 'status', 'lft', 'rgt', 'level', 'parent_id', 'module_id', 'user_id'], 'integer'],
            [['module_id', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['url', 'name'], 'string', 'max' => 255],
            [['about'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'is_category' => Yii::t('app', 'Is Category'),
            'status' => Yii::t('app', 'Status'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'level' => Yii::t('app', 'Level'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'module_id' => Yii::t('app', 'Module ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'url' => Yii::t('app', 'Url'),
            'name' => Yii::t('app', 'Name'),
            'about' => Yii::t('app', 'About'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'user_id']);
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
    public function getPageCounts()
    {
        return $this->hasMany(PageCounts::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageDatas()
    {
        return $this->hasMany(PageData::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageIndices()
    {
        return $this->hasMany(PageIndex::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagePrices()
    {
        return $this->hasMany(PagePrice::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageSessionDatas()
    {
        return $this->hasMany(PageSessionData::className(), ['page_id' => 'id']);
    }
}
