<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BranchesAdmin]].
 *
 * @see BranchesAdmin
 */
class BranchesAdminQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return BranchesAdmin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BranchesAdmin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
