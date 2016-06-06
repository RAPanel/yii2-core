<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%module_settings}}".
 *
 * @property integer $module_id
 * @property integer $sort
 * @property string $url
 * @property string $value
 *
 * @property Module $module
 */
class ModuleSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module_settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'url', 'value'], 'required'],
            [['module_id', 'sort'], 'integer'],
            [['url'], 'string', 'max' => 16],
            [['value'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'module_id' => Yii::t('app', 'Module ID'),
            'sort' => Yii::t('app', 'Sort'),
            'url' => Yii::t('app', 'Url'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'module_id']);
    }
}
