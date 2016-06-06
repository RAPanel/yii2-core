<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%module}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property string $class
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Character[] $characters
 * @property ModuleSettings[] $moduleSettings
 * @property Page[] $pages
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name', 'class'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['url', 'name'], 'string', 'max' => 16],
            [['class'], 'string', 'max' => 256],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'name' => Yii::t('app', 'Name'),
            'class' => Yii::t('app', 'Class'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleSettings()
    {
        return $this->hasMany(ModuleSettings::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['user_id' => 'id']);
    }
}
