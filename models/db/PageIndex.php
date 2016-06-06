<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_index}}".
 *
 * @property integer $page_id
 * @property string $type
 * @property integer $data_id
 *
 * @property PageIndexData $data
 * @property Page $page
 */
class PageIndex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_index}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'type', 'data_id'], 'required'],
            [['page_id', 'data_id'], 'integer'],
            [['type'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'type' => Yii::t('app', 'Type'),
            'data_id' => Yii::t('app', 'Data ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(PageIndexData::className(), ['id' => 'data_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
