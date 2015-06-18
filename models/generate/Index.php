<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_index".
 *
 * @property string $extend_id
 * @property string $base
 * @property string $type
 * @property string $data_id
 *
 * @property IndexData $data
 */
class Index extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_index';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extend_id', 'base', 'type', 'data_id'], 'required'],
            [['extend_id', 'data_id'], 'integer'],
            [['base', 'type'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'extend_id' => Yii::t('rere', 'Extend ID'),
            'base' => Yii::t('rere', 'Base'),
            'type' => Yii::t('rere', 'Type'),
            'data_id' => Yii::t('rere', 'Data ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(IndexData::className(), ['id' => 'data_id']);
    }
}
