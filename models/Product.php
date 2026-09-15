<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $releaseid
 * @property int $mediaid
 * @property string $available_from_date
 * @property int $stock
 *
 * @property OrderItem[] $orderItems
 * @property Price[] $prices
 * @property ProductMedia $productMedias
 * @property Release $releases
 */
class Product extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mediaid'], 'default', 'value' => 1],
            [['stock'], 'default', 'value' => 0],
            [['releaseid', 'available_from_date'], 'required'],
            [['releaseid', 'mediaid', 'stock'], 'integer'],
            [['available_from_date'], 'safe'],
            [['mediaid'], 'exist', 'skipOnError' => true, 'targetClass' => ProductMedia::class, 'targetAttribute' => ['mediaid' => 'id']],
            [['releaseid'], 'exist', 'skipOnError' => true, 'targetClass' => Release::class, 'targetAttribute' => ['releaseid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'releaseid' => Yii::t('app', 'Releaseid'),
            'mediaid' => Yii::t('app', 'Mediaid'),
            'available_from_date' => Yii::t('app', 'Available From Date'),
            'stock' => Yii::t('app', 'Stock'),
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|OrderItemQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['productid' => 'id']);
    }

    /**
     * Gets query for [[Prices]].
     *
     * @return \yii\db\ActiveQuery|PriceQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::class, ['productid' => 'id']);
    }

    /**
     * Gets query for [[ProductMedias]].
     *
     * @return \yii\db\ActiveQuery|ProductMediaQuery
     */
    public function getProductMedias()
    {
        return $this->hasOne(ProductMedia::class, ['id' => 'mediaid']);
    }

    /**
     * Gets query for [[Releases]].
     *
     * @return \yii\db\ActiveQuery|ReleaseQuery
     */
    public function getReleases()
    {
        return $this->hasOne(Release::class, ['id' => 'releaseid']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

}
