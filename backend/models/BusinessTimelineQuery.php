<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BusinessTimeline]].
 *
 * @see BusinessTimeline
 */
class BusinessTimelineQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BusinessTimeline[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinessTimeline|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
