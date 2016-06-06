<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property string $session_id
 * @property integer $status
 * @property integer $is_payed
 * @property integer $delivery_id
 * @property integer $pay_id
 * @property double $total
 * @property resource $data
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cart[] $carts
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'is_payed', 'delivery_id', 'pay_id'], 'integer'],
            [['total'], 'required'],
            [['total'], 'number'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['session_id'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'session_id' => Yii::t('app', 'Session ID'),
            'status' => Yii::t('app', 'Status'),
            'is_payed' => Yii::t('app', 'Is Payed'),
            'delivery_id' => Yii::t('app', 'Delivery ID'),
            'pay_id' => Yii::t('app', 'Pay ID'),
            'total' => Yii::t('app', 'Total'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['order_id' => 'id']);
    }
}
