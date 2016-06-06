<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_index_data}}".
 *
 * @property integer $id
 * @property string $value
 *
 * @property PageIndex[] $pageIndices
 */
class PageIndexData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_index_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string', 'max' => 64],
            [['value'], 'unique']
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageIndices()
    {
        return $this->hasMany(PageIndex::className(), ['data_id' => 'id']);
    }
}
