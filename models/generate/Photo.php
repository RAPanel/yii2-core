<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_photo".
 *
 * @property string $id
 * @property string $sort_id
 * @property string $page_id
 * @property integer $user_id
 * @property string $type
 * @property string $name
 * @property string $width
 * @property string $height
 * @property string $about
 * @property string $cropParams
 * @property string $hash
 * @property string $lastmod
 * @property string $created
 *
 * @property Page $page
 * @property User $user
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort_id', 'type', 'name', 'width', 'height', 'about', 'cropParams', 'hash', 'created'], 'required'],
            [['sort_id', 'page_id', 'user_id', 'width', 'height'], 'integer'],
            [['lastmod', 'created'], 'safe'],
            [['type'], 'string', 'max' => 8],
            [['name', 'about', 'cropParams'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'sort_id' => Yii::t('rere', 'Sort ID'),
            'page_id' => Yii::t('rere', 'Page ID'),
            'user_id' => Yii::t('rere', 'User ID'),
            'type' => Yii::t('rere', 'Type'),
            'name' => Yii::t('rere', 'Name'),
            'width' => Yii::t('rere', 'Width'),
            'height' => Yii::t('rere', 'Height'),
            'about' => Yii::t('rere', 'About'),
            'cropParams' => Yii::t('rere', 'Crop Params'),
            'hash' => Yii::t('rere', 'Hash'),
            'lastmod' => Yii::t('rere', 'Lastmod'),
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
