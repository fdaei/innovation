<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Businesses]].
 *
 * @see Businesses
 */
class BusinessesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Businesses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Businesses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
