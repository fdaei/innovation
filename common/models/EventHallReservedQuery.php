<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[EventHallReserved]].
 *
 * @see EventHallReserved
 */
class EventHallReservedQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->where(['deleted_at'=> 0]);
    }

    /**
     * {@inheritdoc}
     * @return EventHallReserved[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventHallReserved|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
