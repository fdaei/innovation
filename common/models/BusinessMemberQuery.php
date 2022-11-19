<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusinessMember]].
 *
 * @see BusinessMember
 */
class BusinessMemberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BusinessMember[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinessMember|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active(): BusinessMemberQuery
    {
        return $this->onCondition(['<>', 'status', BusinessMember::STATUS_DELETED]);
    }
}
