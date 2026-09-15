<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ReleaseType]].
 *
 * @see ReleaseType
 */
class ReleaseTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ReleaseType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ReleaseType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
