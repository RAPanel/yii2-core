<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%price_type}}".
 *
 * @property integer $id
 * @property integer $sort
 * @property integer $is_default
 * @property string $name
 * @property string $currency
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PagePrice[] $pagePrices
 */
class PriceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'is_default'], 'integer'],
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sort' => Yii::t('app', 'Sort'),
            'is_default' => Yii::t('app', 'Is Default'),
            'name' => Yii::t('app', 'Name'),
            'currency' => Yii::t('app', 'Currency'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagePrices()
    {
        return $this->hasMany(PagePrice::className(), ['type_id' => 'id']);
    }
}
