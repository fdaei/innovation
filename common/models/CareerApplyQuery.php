<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OrgUnit]].
 *
 * @see OrgUnit
 */
class CareerApplyQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', 'status',  OrgUnit::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return OrgUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrgUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
