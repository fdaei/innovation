<?php

namespace common\models;


/**
 * This is the ActiveQuery class for [[OauthClients]].
 *
 * @see OauthClients
 */
class OauthClientsQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return OauthClients[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OauthClients|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byPrivate($not = false)
    {
        return $not ?
            $this->andWhere(['not', [OauthClients::tableName() . '.private' => OauthClients::IS_PRIVATE]])
            :
            $this->andWhere([OauthClients::tableName() . '.private' => OauthClients::NOT_PRIVATE]);
    }
}