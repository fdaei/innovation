<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[EventOrganizer]].
 *
 * @see EventOrganizer
 */
class EventOrganizerQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['=', 'deleted_at',  0]);
    }

    /**
     * {@inheritdoc}
     * @return EventOrganizer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventOrganizer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
