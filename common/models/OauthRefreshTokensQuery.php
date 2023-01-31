<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[OauthRefreshTokens]].
 *
 * @see OauthRefreshTokens
 */
class OauthRefreshTokensQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return OauthRefreshTokens[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OauthRefreshTokens|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byScope($scope)
    {
        return $this->andWhere(['like', OauthRefreshTokens::tableName() . '.scope', $scope]);
    }

    public function byClientId($client_id)
    {
        return $this->andWhere([OauthRefreshTokens::tableName() . '.client_id' => $client_id]);
    }

    public function byUser($user_id)
    {
        return $this->andWhere([OauthRefreshTokens::tableName() . '.user_id' => $user_id]);
    }

    public function notExpire()
    {
        return $this->andWhere(['>', OauthRefreshTokens::tableName() . '.expires', date('Y-m-d H:i:s', time())]);
    }
}