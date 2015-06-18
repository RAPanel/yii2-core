<?php

namespace rere\core\models;

use Yii;

/**
 * This is the model class for table "{{%character}}".
 *
 * @property string $url
 * @property string $type
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
            [['url', 'type'], 'required'],
            [['url'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => Yii::t('rere.model', 'Url'),
            'type' => Yii::t('rere.model', 'Type'),
        ];
    }
}
