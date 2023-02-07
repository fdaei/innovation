<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Mentors]].
 *
 * @see Mentors
 */
class MentorsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Mentors[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Mentors|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
