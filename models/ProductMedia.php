<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_medias".
 *
 * @property int $id
 * @property string $name
 *
 * @property Product[] $products
 */
class ProductMedia extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_medias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20],
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
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['mediaid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductMediaQuery(get_called_class());
    }

}
