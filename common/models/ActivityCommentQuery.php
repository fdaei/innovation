<?php

namespace common\models;

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
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ActivityComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
