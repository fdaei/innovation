<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Mentor]].
 *
 * @see Mentor
 */
class MentorsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', 'status',  Mentor::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return Mentor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Mentor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
