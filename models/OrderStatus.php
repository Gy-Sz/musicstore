<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_statuses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Order[] $orders
 */
class OrderStatus extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['statusid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OrderStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderStatusQuery(get_called_class());
    }

}
