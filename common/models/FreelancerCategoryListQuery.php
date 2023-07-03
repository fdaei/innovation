<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FreelancerCategoryList]].
 *
 * @see FreelancerCategoryList
 */
class FreelancerCategoryListQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return FreelancerCategoryList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FreelancerCategoryList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
