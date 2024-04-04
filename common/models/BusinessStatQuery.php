<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusinessStat]].
 *
 * @see BusinessStat
 */
class BusinessStatQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return BusinessStat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinessStat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active(): BusinessStatQuery
    {
        return $this->onCondition(['<>', 'status', BusinessStat::STATUS_DELETED]);
    }
}
