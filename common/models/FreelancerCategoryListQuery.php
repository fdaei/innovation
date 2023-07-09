<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[FreelancerCategoryList]].
 *
 * @see FreelancerCategoryList
 * @mixin SoftDeleteQueryBehavior
 */
class FreelancerCategoryListQuery extends ActiveQuery
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

    public function behaviors()
    {
        return [
            'softDelete' => [
                'class' => SoftDeleteQueryBehavior::class,
            ],
        ];
    }

}
