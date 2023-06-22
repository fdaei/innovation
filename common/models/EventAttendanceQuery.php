<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[EventAttendance]].
 *
 * @see EventAttendance
 */
class EventAttendanceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EventAttendance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventAttendance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
