<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "release_types".
 *
 * @property int $id
 * @property string $name
 *
 * @property Release[] $releases
 */
class ReleaseType extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'release_types';
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
     * Gets query for [[Releases]].
     *
     * @return \yii\db\ActiveQuery|ReleaseQuery
     */
    public function getReleases()
    {
        return $this->hasMany(Release::class, ['typeid' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ReleaseTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReleaseTypeQuery(get_called_class());
    }

}
