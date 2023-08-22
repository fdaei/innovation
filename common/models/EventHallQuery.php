<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[EventHall]].
 *
 * @see EventHall
 */
class EventHallQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->where(['deleted_at'=> 0]);
    }

    /**
     * {@inheritdoc}
     * @return EventHall[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventHall|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
