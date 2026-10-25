<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $orderid
 * @property int $productid
 * @property float $price_value
 * @property string $price_currency
 * @property int $quantity
 *
 * @property Order $orders
 * @property Product $products
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity'], 'default', 'value' => 1],
            [['orderid', 'productid'], 'required'],
            [['orderid', 'productid', 'quantity'], 'integer'],
            [['price_value'], 'number'],
            [['price_currency'], 'string', 'max' => 3],
            [['price_value'], 'validatePriceSnapshot'],
            [['orderid'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['orderid' => 'id']],
            [['productid'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['productid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orderid' => Yii::t('app', 'Orderid'),
            'productid' => Yii::t('app', 'Productid'),
            'price_value' => Yii::t('app', 'Price'),
            'price_currency' => Yii::t('app', 'Currency'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

    public function validatePriceSnapshot(string $attribute): void
    {
        $priceValue = $this->getAttribute('price_value');
        $priceCurrency = $this->getAttribute('price_currency');
        $priceValueIsBlank = $priceValue === null || $priceValue === '';
        $priceCurrencyIsBlank = $priceCurrency === null || $priceCurrency === '';

        if ($priceValueIsBlank && $priceCurrencyIsBlank) {
            return;
        }

        if ($priceValueIsBlank) {
            $this->addError($attribute, Yii::t('app', 'Enter a price when a currency is provided.'));
        }
        if ($priceCurrencyIsBlank) {
            $this->addError('price_currency', Yii::t('app', 'Enter a currency when a price is provided.'));
        }
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery|OrderQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Order::class, ['id' => 'orderid']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Product::class, ['id' => 'productid']);
    }

    /**
     * {@inheritdoc}
     * @return OrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderItemQuery(get_called_class());
    }
}
