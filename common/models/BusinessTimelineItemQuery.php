<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusinessTimelineItem]].
 *
 * @see BusinessTimelineItem
 */
class BusinessTimelineItemQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return BusinessTimelineItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinessTimelineItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}