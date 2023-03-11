<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Freelancer]].
 *
 * @see Freelancer
 */
class FreelancerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Freelancer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Freelancer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
