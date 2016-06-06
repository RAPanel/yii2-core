<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_price}}".
 *
 * @property integer $id
 * @property integer $page_id
 * @property integer $type_id
 * @property double $value
 * @property integer $count
 * @property string $unit
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Page $page
 * @property PriceType $type
 */
class PagePrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'value'], 'required'],
            [['page_id', 'type_id', 'count'], 'integer'],
            [['value'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['unit'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'page_id' => Yii::t('app', 'Page ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'value' => Yii::t('app', 'Value'),
            'count' => Yii::t('app', 'Count'),
            'unit' => Yii::t('app', 'Unit'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PriceType::className(), ['id' => 'type_id']);
    }
}
