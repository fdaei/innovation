<?php

namespace common\models;

use Yii;

/**
 *
 * @property boolean $private
 * @property User $user
 *
 * Class OauthClients
 * @package common\models
 */
class OauthClients extends \filsh\yii2\oauth2server\models\OauthClients
{

    const IS_PRIVATE = 1;
    const NOT_PRIVATE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%oauth_clients}}';
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
    public function canUpdate()
    {
        return !$this->private;
    }

    /**
     * @return boolean
     */
    public function canDelete()
    {
        return false;
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Access' => [
                self::IS_PRIVATE => Yii::t("app", "Private"),
                self::NOT_PRIVATE => Yii::t("app", "Not Private")
            ],
            'AccessColor' => [
                self::IS_PRIVATE => 'warning',
                self::NOT_PRIVATE => 'success'
            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    /**
     * @inheritdoc
     * @return OauthClientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OauthClientsQuery(get_called_class());
    }
}