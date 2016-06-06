<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $about
 * @property string $hash
 * @property string $created_at
 * @property string $updated_at
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 8],
            [['about'], 'string', 'max' => 1024],
            [['hash'], 'string', 'max' => 32]
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
            'type' => Yii::t('app', 'Type'),
            'about' => Yii::t('app', 'About'),
            'hash' => Yii::t('app', 'Hash'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
