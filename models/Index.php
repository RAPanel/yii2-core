<?php

namespace rere\core\models;

use Yii;
use yii\web\HttpException;

/**
 * This is the model class for table "{{%index}}".
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
        return '{{%index}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'model', 'type', 'data_id'], 'required'],
            [['owner_id', 'data_id'], 'integer'],
            [['model', 'type'], 'string', 'max' => 16],
            [['data'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'extend_id' => Yii::t('rere.model', 'Extend ID'),
            'base' => Yii::t('rere.model', 'Base'),
            'type' => Yii::t('rere.model', 'Type'),
            'data_id' => Yii::t('rere.model', 'Data ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(IndexData::className(), ['id' => 'data_id']);
    }

    public function setData($value)
    {
        $model = IndexData::findOne(['value'=>$value]);
        if(!$model){
            $model = new IndexData();
            $model->value = $value;
            if(!$model->save())
                throw new HttpException(400, $model->errors);
        }
        $this->data_id = $model->id;
    }

    public static function add($data)
    {
        $list = (array)$data['data'];
        foreach($list as $row){
            $data['data'] = $row;
            $model = new Index();
            $model->setAttributes($data);
            $model->save(false);
        }
    }
}
