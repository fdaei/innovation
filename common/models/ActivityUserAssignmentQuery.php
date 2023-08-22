<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ActivityUserAssignment]].
 *
 * @see ActivityUserAssignment
 */
class ActivityUserAssignmentQuery extends \yii\db\ActiveQuery
{
    private $all;


    /**
     * {@inheritdoc}
     * @return ActivityUserAssignment[]|array
     */
    public function all($db = null)
    {
        $this->all = parent::all($db);
        return $this->all;
    }

    /**
     * {@inheritdoc}
     * @return ActivityUserAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
