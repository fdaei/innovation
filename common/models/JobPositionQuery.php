<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[JobPosition]].
 *
 * @see JobPosition
 */
class JobPositionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', 'status',  JobPosition::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return JobPosition[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JobPosition|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
