<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ContactUs]].
 *
 * @see ContactUs
 */
class ContactUsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ContactUs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ContactUs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
