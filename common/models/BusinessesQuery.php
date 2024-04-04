<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Businesses]].
 *
 * @see Businesses
 */
class BusinessesQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Businesses[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Businesses|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->onCondition(['=', 'deleted_at', 0]);
    }

    public function bySlug($slug)
    {
        return $this->andWhere(Businesses::tableName() . '.slug=:slug', [':slug' => $slug]);
    }
}