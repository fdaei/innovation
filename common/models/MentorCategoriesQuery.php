<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[MentorCategories]].
 *
 * @see MentorCategories
 * @mixin SoftDeleteQueryBehavior
 */
class MentorCategoriesQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return MentorCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MentorCategories|array|null
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
