<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property string $about
 * @property string $cropParams
 * @property string $hash
 * @property string $created_at
 * @property string $updated_at
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'width', 'height', 'hash'], 'required'],
            [['width', 'height'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'cropParams'], 'string', 'max' => 255],
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
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'about' => Yii::t('app', 'About'),
            'cropParams' => Yii::t('app', 'Crop Params'),
            'hash' => Yii::t('app', 'Hash'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
