<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BranchesGallery]].
 *
 * @see BranchesGallery
 */
class BranchesGalleryQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return BranchesGallery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BranchesGallery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->where(['deleted_at'=>0]);
    }
}
