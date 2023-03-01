<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[MentorsAdviceRequest]].
 *
 * @see MentorsAdviceRequest
 */
class MentorsAdviceRequestQuery extends \yii\db\ActiveQuery
{


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

    public function active()
    {
        return $this->where(['deleted_at'=> 0]);
    }
}
