<?php

namespace common\models;

use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[FreelancerPortfolio]].
 *
 * @see FreelancerPortfolio
 * @mixin SoftDeleteQueryBehavior
 */
class FreelancerPortfolioQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return FreelancerPortfolio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FreelancerPortfolio|array|null
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
