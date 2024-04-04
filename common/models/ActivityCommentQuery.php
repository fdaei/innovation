<?php

namespace common\models;

use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[ActivityComment]].
 *
 * @see ActivityComment
 */
class ActivityCommentQuery extends \yii\db\ActiveQuery
{


    /**
     * {@inheritdoc}
     * @return ActivityComment[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ActivityComment|array|null
     */
    public function one($db = null): array|ActivityComment|null
    {
        return parent::one($db);
    }
    public function behaviors(): array
    {
        return [
            'softDelete' => [
                'class' => SoftDeleteQueryBehavior::class,
            ],
        ];
    }
}
