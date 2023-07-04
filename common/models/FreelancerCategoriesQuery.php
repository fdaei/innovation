<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[FreelancerCategories]].
 *
 * @see FreelancerCategories
 */
class FreelancerCategoriesQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return FreelancerCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FreelancerCategories|array|null
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
