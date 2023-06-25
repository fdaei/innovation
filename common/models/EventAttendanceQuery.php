<?php

namespace common\models;

use yii2tech\ar\softdelete\SoftDeleteQueryBehavior;

/**
 * This is the ActiveQuery class for [[EventAttendance]].
 *
 * @see EventAttendance
 * @mixin SoftDeleteQueryBehavior
 */
class EventAttendanceQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return EventAttendance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EventAttendance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function behaviors()
    {
        return [
            'softDelete' => [
                'class' => SoftDeleteQueryBehavior::class,
            ],
        ];
    }
}
