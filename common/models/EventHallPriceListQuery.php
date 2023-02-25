<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[EventHallPriceList]].
 *
 * @see EventHallPriceList
 */
class EventHallPriceListQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->where(['deleted_at'=> 0]);
    }

    /**
     * {@inheritdoc}
     * @return EventHallPriceList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventHallPriceList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
