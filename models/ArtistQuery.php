<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Artist]].
 *
 * @see Artist
 */
class ArtistQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Artist[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Artist|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
