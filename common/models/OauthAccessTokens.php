<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oauth_access_tokens".
 *
 * @property string $access_token
 * @property string $client_id
 * @property int $user_id
 * @property string $expires
 * @property string $scope
 * @property boolean $isExpire
 *
 * @property OauthClients $client
 * @property OauthSession $session
 * @property User $user
 */
class OauthAccessTokens extends \yii\db\ActiveRecord
{
    const LIMIT_TERMINATE_TIME = 86400; // 24 Hours

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%oauth_access_tokens}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['access_token', 'client_id'], 'required'],
            [['user_id'], 'integer'],
            [['expires', 'additional_data'], 'safe'],
            [['access_token'], 'string', 'max' => 2048],
            [['client_id'], 'string', 'max' => 128],
            [['scope'], 'string', 'max' => 2000],
            [['access_token'], 'unique'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => OauthClients::class, 'targetAttribute' => ['client_id' => 'client_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'access_token'         => 'Access Token',
            'client_id'            => 'Client ID',
            'user_id'              => 'User ID',
            'expires'              => 'Expires',
            'scope'                => 'Scope'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(OauthClients::class, ['client_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(OauthSession::class, ['access_token' => 'access_token']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return boolean
     */
    public function getIsExpire()
    {
        return $this->expires < date('Y-m-d H:i:s', time());
    }

    /**
     * @return boolean
     */
    public function terminate()
    {
        return $this->expire();
    }

    public function expire()
    {
        $this->expires = date('Y-m-d H:i:s');
        return $this->save();
    }

    public static function getCurrentAccessToken()
    {
        $receivedHeaders = Yii::$app->request->getHeaders();
        preg_match('/Bearer\s(\S+)/i', $receivedHeaders->get('authorization'), $matchesToken);
        return $matchesToken ? OauthAccessTokens::find()->byToken($matchesToken[1])->one() : null;
    }

    /**
     * @inheritdoc
     * @return OauthAccessTokensQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OauthAccessTokensQuery(get_called_class());
    }
}