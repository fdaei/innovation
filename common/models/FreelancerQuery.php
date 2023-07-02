<?php

namespace common\models;

use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[Freelancer]].
 *
 * @see Freelancer
 * @mixin SoftDeleteQueryBehavior
 */
class FreelancerQuery extends \yii\db\ActiveQuery
{
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
    public function behaviors()
    {
        return [
            'softDelete' => [
                'class' => SoftDeleteQueryBehavior::class,
            ],
        ];
    }
}
