<?php

namespace rere\core\defaultModels;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property string $id
 * @property string $path
 * @property string $inputType
 * @property string $name
 * @property string $value
 * @property string $update_at
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'name'], 'required'],
            [['value'], 'string'],
            [['update_at'], 'safe'],
            [['path', 'name'], 'string', 'max' => 64],
            [['inputType'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'path' => Yii::t('rere', 'Path'),
            'inputType' => Yii::t('rere', 'Input Type'),
            'name' => Yii::t('rere', 'Name'),
            'value' => Yii::t('rere', 'Value'),
            'update_at' => Yii::t('rere', 'Update At'),
        ];
    }
}
