<?php

namespace common\models;

use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[MentorsAdviceRequest]].
 *
 * @see MentorsAdviceRequest
 * @mixin SoftDeleteQueryBehavior
 */
class MentorsAdviceRequestQuery extends \yii\db\ActiveQuery
{
    public function behaviors(): array
    {
        return [
            'SoftDeleteQueryBehavior' => [
                'class' => SoftDeleteQueryBehavior::class,
            ],
        ];
    }
    /**
     * {@inheritdoc}
     * @return MentorsAdviceRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MentorsAdviceRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
