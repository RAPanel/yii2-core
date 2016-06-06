<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%text}}".
 *
 * @property integer $id
 * @property string $value
 */
class Text extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%text}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
