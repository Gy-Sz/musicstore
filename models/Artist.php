<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "artists".
 *
 * @property int $id
 * @property string $name
 * @property string|null $country
 *
 * @property Release[] $releases
 */
class Artist extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country'], 'default', 'value' => null],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['country'], 'string', 'max' => 20],
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
            'country' => Yii::t('app', 'Country'),
        ];
    }

    /**
     * Gets query for [[Releases]].
     *
     * @return \yii\db\ActiveQuery|ReleaseQuery
     */
    public function getReleases()
    {
        return $this->hasMany(Release::class, ['artistid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ArtistQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArtistQuery(get_called_class());
    }

}
