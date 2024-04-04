<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BranchesSpecification]].
 *
 * @see BranchesSpecification
 */
class BranchesSpecificationQuery extends \yii\db\ActiveQuery
{


    /**
     * {@inheritdoc}
     * @return BranchesSpecification[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BranchesSpecification|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active()
    {
        return $this->where(['deleted_at'=>0]);
    }
}
