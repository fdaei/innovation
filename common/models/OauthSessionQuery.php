<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OauthSession]].
 *
 * @see OauthSession
 */
class OauthSessionQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return OauthSession[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OauthSession|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->onCondition([OauthSession::tableName() . '.status' => OauthSession::STATUS_ACTIVE]);
    }

    /**
     * @return OauthSessionQuery
     */
    public function notExpireAccessToken(): OauthSessionQuery
    {
        return $this
            ->joinWith(['accessToken'])
            ->andWhere(['>', OauthAccessTokens::tableName() . '.expires', date('Y-m-d H:i:s', time())]);
    }

    public function haveDeviceToken()
    {
        return $this->andWhere('NULLIF(TRIM(' . OauthSession::tableName() . '.device_token),"") IS NOT NULL');
    }
}