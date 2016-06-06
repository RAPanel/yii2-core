<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%character}}".
 *
 * @property integer $id
 * @property integer $module_id
 * @property integer $is_category
 * @property integer $page_id
 * @property integer $sort
 * @property string $url
 * @property string $name
 * @property string $type
 * @property integer $multi
 * @property integer $index
 * @property integer $filter
 * @property resource $data
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Module $module
 * @property CharacterReference[] $characterReferences
 * @property Reference[] $references
 * @property PageCharacters[] $pageCharacters
 */
class Character extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%character}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'is_category', 'page_id', 'sort', 'multi', 'index', 'filter'], 'integer'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['url'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'module_id' => Yii::t('app', 'Module ID'),
            'is_category' => Yii::t('app', 'Is Category'),
            'page_id' => Yii::t('app', 'Page ID'),
            'sort' => Yii::t('app', 'Sort'),
            'url' => Yii::t('app', 'Url'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'multi' => Yii::t('app', 'Multi'),
            'index' => Yii::t('app', 'Index'),
            'filter' => Yii::t('app', 'Filter'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterReferences()
    {
        return $this->hasMany(CharacterReference::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferences()
    {
        return $this->hasMany(Reference::className(), ['id' => 'reference_id'])->viaTable('{{%character_reference}}', ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageCharacters()
    {
        return $this->hasMany(PageCharacters::className(), ['character_id' => 'id']);
    }
}
