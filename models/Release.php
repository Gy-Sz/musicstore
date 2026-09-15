<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "releases".
 *
 * @property int $id
 * @property string $title
 * @property int $artistid
 * @property string $date
 * @property int $typeid
 * @property string|null $genre
 *
 * @property Artist $artists
 * @property Product[] $products
 * @property ReleaseType $releaseTypes
 */
class Release extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'releases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genre'], 'default', 'value' => null],
            [['typeid'], 'default', 'value' => 1],
            [['title', 'artistid', 'date'], 'required'],
            [['artistid', 'typeid'], 'integer'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['genre'], 'string', 'max' => 50],
            [['artistid'], 'exist', 'skipOnError' => true, 'targetClass' => Artist::class, 'targetAttribute' => ['artistid' => 'id']],
            [['typeid'], 'exist', 'skipOnError' => true, 'targetClass' => ReleaseType::class, 'targetAttribute' => ['typeid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'artistid' => Yii::t('app', 'Artistid'),
            'date' => Yii::t('app', 'Date'),
            'typeid' => Yii::t('app', 'Typeid'),
            'genre' => Yii::t('app', 'Genre'),
        ];
    }

    /**
     * Gets query for [[Artists]].
     *
     * @return \yii\db\ActiveQuery|ArtistQuery
     */
    public function getArtists()
    {
        return $this->hasOne(Artist::class, ['id' => 'artistid']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['releaseid' => 'id']);
    }

    /**
     * Gets query for [[ReleaseTypes]].
     *
     * @return \yii\db\ActiveQuery|ReleaseTypeQuery
     */
    public function getReleaseTypes()
    {
        return $this->hasOne(ReleaseType::class, ['id' => 'typeid']);
    }

    /**
     * {@inheritdoc}
     * @return ReleaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReleaseQuery(get_called_class());
    }

}
