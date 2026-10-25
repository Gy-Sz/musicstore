<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property int $id
 * @property int $productid
 * @property float $value
 * @property string $currency
 * @property string $startdate
 * @property string $enddate
 *
 * @property Product $products
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency'], 'default', 'value' => 'eur'],
            [['productid', 'value', 'startdate', 'enddate'], 'required'],
            [['productid'], 'integer'],
            [['value'], 'number'],
            [['startdate', 'enddate'], 'safe'],
            [['currency'], 'string', 'max' => 3],
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
            'productid' => Yii::t('app', 'Productid'),
            'value' => Yii::t('app', 'Value'),
            'currency' => Yii::t('app', 'Currency'),
            'startdate' => Yii::t('app', 'Startdate'),
            'enddate' => Yii::t('app', 'Enddate'),
        ];
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
     * @return PriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriceQuery(get_called_class());
    }
}
