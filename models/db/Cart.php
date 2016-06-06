<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property integer $id
 * @property string $session_id
 * @property integer $status
 * @property string $item_id
 * @property integer $order_id
 * @property double $price
 * @property double $quantity
 * @property double $total
 * @property resource $data
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Order $order
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'item_id', 'data'], 'required'],
            [['status', 'order_id'], 'integer'],
            [['price', 'quantity', 'total'], 'number'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['session_id'], 'string', 'max' => 40],
            [['item_id'], 'string', 'max' => 32]
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
            'item_id' => Yii::t('app', 'Item ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'price' => Yii::t('app', 'Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'total' => Yii::t('app', 'Total'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
