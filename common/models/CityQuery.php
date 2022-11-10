<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[City]].
 *
 * @see City
 */
class CityQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return City[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return City|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return CityQuery
     */
    public function active(): CityQuery
    {
        return $this->onCondition(['<>', 'status' => City::STATUS_DELETED]);
    }
}