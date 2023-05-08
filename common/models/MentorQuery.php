<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Mentor]].
 *
 * @see Mentor
 */
class MentorQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->where(['deleted_at'=> 0,'status'=>Mentor::STATUS_ACTIVE]);
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
