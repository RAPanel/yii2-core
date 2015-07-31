<?php

namespace rere\core\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module_settings}}".
 *
 * @property string $module_id
 * @property string $url
 * @property string $value
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
            [['url', 'value'], 'required'],
            [['url'], 'string', 'max' => 16],
            [['value'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'module_id' => Yii::t('rere.model', 'Module ID'),
            'url' => Yii::t('rere.model', 'Url'),
            'value' => Yii::t('rere.model', 'Value'),
        ];
    }

    public static function get($id)
    {
        return ArrayHelper::map(self::findAll($id), 'url', 'value');
    }
}
