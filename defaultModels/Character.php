<?php

namespace rere\core\defaultModels;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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

    public static function typeMap()
    {
        return ArrayHelper::map(self::all(), 'url', 'type');
    }

    public static function all()
    {
        return self::find()->all();
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
            'url' => Yii::t('rere', 'Url'),
            'type' => Yii::t('rere', 'Type'),
        ];
    }

    public function field($value = null, $options = [])
    {
        return Html::hiddenInput('PageCharacters[' . $this->id . '][name]', $this->url, $options) . Html::input($this->type, 'PageCharacters[' . $this->id . '][value]', $value, $options);
    }

    public function getId()
    {
        $id = '';
        for ($i = 0; $i < strlen($this->url); $i++) {
            $id .= decbin(ord($this->url[$i]));
        }
        return $id;
    }
}
