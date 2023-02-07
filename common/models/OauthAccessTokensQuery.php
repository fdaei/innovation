<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OauthAccessTokens]].
 *
 * @see OauthAccessTokens
 */
class OauthAccessTokensQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return OauthAccessTokens[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OauthAccessTokens|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byToken($token)
    {
        return $this->andWhere([OauthAccessTokens::tableName() . '.access_token' => $token]);
    }

    public function byScope($scope)
    {
        return $this->andWhere(['like', OauthAccessTokens::tableName() . '.scope', $scope]);
    }

    public function byClientId($client_id)
    {
        return $this->andWhere([OauthAccessTokens::tableName() . '.client_id' => $client_id]);
    }

    public function byUser($user_id)
    {
        return $this->andWhere([OauthAccessTokens::tableName() . '.user_id' => $user_id]);
    }

    /**
     * @return OauthAccessTokensQuery
     */
    public function notExpire(): OauthAccessTokensQuery
    {
        return $this->andWhere(['>', OauthAccessTokens::tableName() . '.expires', date('Y-m-d H:i:s', time())]);
    }
}