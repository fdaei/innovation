<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserVerify]].
 *
 * @see UserVerify
 */
class UserVerifyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UserVerify[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserVerify|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
