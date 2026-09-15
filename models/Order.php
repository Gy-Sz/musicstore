<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $datetime
 * @property int|null $customerid
 * @property int $statusid
 *
 * @property Customer $customers
 * @property OrderItem[] $orderItems
 * @property OrderStatus $orderStatuses
 */
class Order extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customerid'], 'default', 'value' => null],
            [['statusid'], 'default', 'value' => 1],
            [['datetime'], 'safe'],
            [['customerid', 'statusid'], 'integer'],
            [['statusid'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['statusid' => 'id']],
            [['customerid'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customerid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'datetime' => Yii::t('app', 'Datetime'),
            'customerid' => Yii::t('app', 'Customerid'),
            'statusid' => Yii::t('app', 'Statusid'),
        ];
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery|CustomerQuery
     */
    public function getCustomers()
    {
        return $this->hasOne(Customer::class, ['id' => 'customerid']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|OrderItemQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['orderid' => 'id']);
    }

    /**
     * Gets query for [[OrderStatuses]].
     *
     * @return \yii\db\ActiveQuery|OrderStatusQuery
     */
    public function getOrderStatuses()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'statusid']);
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

}
