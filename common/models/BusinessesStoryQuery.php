<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[BusinessesStory]].
 *
 * @see BusinessesStory
 */
class BusinessesStoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BusinessesStory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BusinessesStory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
