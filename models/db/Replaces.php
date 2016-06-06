<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%replaces}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class Replaces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%replaces}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'url'], 'string', 'max' => 64],
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
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
