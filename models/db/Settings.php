<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $path
 * @property string $input
 * @property string $name
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
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
            [['input'], 'required'],
            [['value'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['path', 'name'], 'string', 'max' => 64],
            [['input'], 'string', 'max' => 8],
            [['path'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'input' => Yii::t('app', 'Input'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
