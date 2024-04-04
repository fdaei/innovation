<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusinessTimeline]].
 *
 * @see BusinessTimeline
 */
class BusinessTimelineQuery extends \yii\db\ActiveQuery
{

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

    public function active(): BusinessTimelineQuery
    {
        return $this->onCondition(['<>', 'status', BusinessTimeline::STATUS_DELETED]);
    }

}
