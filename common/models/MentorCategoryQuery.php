<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[MentorCategory]].
 *
 * @see MentorCategory
 * @mixin SoftDeleteQueryBehavior
 */
class MentorCategoryQuery extends ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return MentorCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MentorCategory|array|null
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
