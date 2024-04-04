<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusinessGallery]].
 *
 * @see BusinessGallery
 */
class BusinessGalleryQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return BusinessGallery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinessGallery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active(): BusinessGalleryQuery
    {
        return $this->onCondition(['<>', 'status', BusinessGallery::STATUS_DELETED]);
    }
}
