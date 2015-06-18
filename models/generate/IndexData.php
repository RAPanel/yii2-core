<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_index_data".
 *
 * @property string $id
 * @property string $value
 *
 * @property Index[] $indices
 */
class IndexData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_index_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'value' => Yii::t('rere', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndices()
    {
        return $this->hasMany(Index::className(), ['data_id' => 'id']);
    }
}
