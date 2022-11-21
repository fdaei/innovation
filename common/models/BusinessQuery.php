<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Business]].
 *
 * @see Business
 */
class BusinessQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Business[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Business|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active(): BusinessQuery
    {
        return $this->onCondition(['<>', 'status', Business::STATUS_DELETED]);
    }

    public function bySlug($slug)
    {
        return $this->andWhere(Business::tableName() . '.slug=:slug', [':slug' => $slug]);
    }
}