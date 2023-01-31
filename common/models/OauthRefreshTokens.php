<?php

namespace common\models;

use Yii;

class OauthRefreshTokens extends \filsh\yii2\oauth2server\models\OauthRefreshTokens
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%oauth_refresh_tokens}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['refresh_token', 'client_id'], 'required'],
            [['user_id'], 'integer'],
            [['expires'], 'safe'],
            [['refresh_token'], 'string', 'max' => 2048],
            [['client_id'], 'string', 'max' => 128],
            [['scope'], 'string', 'max' => 2000],
            [['refresh_token'], 'unique'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => OauthClients::class, 'targetAttribute' => ['client_id' => 'client_id']],
        ];
    }

    public function expire()
    {
        $this->expires = date('Y-m-d H:i:s');
        if ($this->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     * @return OauthRefreshTokensQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OauthRefreshTokensQuery(get_called_class());
    }
}