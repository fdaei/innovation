<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Tag]].
 *
 * @see Tag
 */
class TagQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Tag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byType($type)
    {
        return $this->andWhere([Tag::tableName() . '.type' => $type]);
    }

    public function forUser()
    {
        return $this->byType(Tag::TYPE_USER);
    }

    public function byStatus($status, $not = false)
    {
        return $not ?
            $this
            ->andWhere(['not', [Tag::tableName() . '.status' => $status]])
            :
            $this
            ->andWhere([Tag::tableName() . '.status' => $status]);
    }

    public function active()
    {
        return $this->onCondition(['<>', Tag::tableName() . '.status', Tag::STATUS_DELETED]);
    }

    public function byIds($ids)
    {
        return $this->andWhere([Tag::tableName() . '.tag_id' => $ids]);
    }
}
