<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%oauth_session}}".
 *
 * @property int $id
 * @property string $access_token
 * @property string $refresh_token
 * @property string $device_name
 * @property string $device_imei
 * @property string $device_token
 * @property string $token
 * @property int $application
 * @property string $app_version
 * @property string $os
 * @property string $system_version
 * @property string $api_level
 * @property string $ip_address
 * @property int $user_agent
 * @property int $last_activity_action
 * @property int $platform
 * @property int $created_at
 * @property int $updated_at
 * @property int $updated_by
 * @property int $status
 *
 * @property User $updatedBy
 * @property OauthAccessTokens $accessToken
 * @property OauthRefreshTokens $refreshToken
 */
class OauthSession extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_TERMINATED = 2;
    const STATUS_DELETED = 3;

    const AVINOX_APP = 1;
    const AVINOX_WEB = 2;

    const PLATFORM_WEB = 1;
    const PLATFORM_MOBILE = 2;

    const TYPE_API = 1;
    const TYPE_WEB = 2;

    const OS_ANDROID = 1;
    const OS_IOS = 2;

    const SCENARIO_CHANGE_STATUS = 'change-status';

    public $api_level;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%oauth_session}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application', 'access_token', 'platform'], 'required'],
            [['user_agent'], 'required', 'when' => function ($model) {
                return $this->platform == self::PLATFORM_WEB;
            }],
            [['status', 'application', 'platform'], 'integer'],
            [['device_name'], 'string', 'max' => 50],
            [['device_imei'], 'string', 'max' => 15],
            [['device_token'], 'string', 'max' => 255],
            [['api_level'], 'filter', 'filter' => function ($value) {
                return (string)$value;
            }],
            [['api_level'], 'string', 'max' => 10],
            [['ip_address'], 'string', 'max' => 39],
            [['system_version'], 'string', 'max' => 20],
            [['app_version'], 'string', 'max' => 15],
            [['user_agent'], 'string', 'max' => 512],
            [['access_token', 'refresh_token'], 'string', 'max' => 40],
            [['last_activity_action'], 'string', 'max' => 128],
            ['platform', 'in', 'range' => array_keys(self::itemAlias('Platform'))],
            ['application', 'in', 'range' => array_keys(self::itemAlias('Application'))],
            ['status', 'in', 'range' => array_keys(self::itemAlias('Status'))],
            [['updated_by'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['access_token'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => OauthAccessTokens::class, 'targetAttribute' => ['access_token' => 'access_token']],
            [['refresh_token'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => OauthRefreshTokens::class, 'targetAttribute' => ['refresh_token' => 'refresh_token']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CHANGE_STATUS] = ['!status'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'access_token' => Yii::t('app', 'Access Token'),
            'refresh_token' => Yii::t('app', 'Refresh Token'),
            'device_name' => Yii::t('app', 'Device Name'),
            'device_imei' => Yii::t('app', 'Device IMEI'),
            'device_token' => Yii::t('app', 'Device Token'),
            'user_agent' => Yii::t('app', 'User Agent'),
            'os' => Yii::t('app', 'OS'),
            'ip_address' => Yii::t('app', 'IP Address'),
            'platform' => Yii::t('app', 'Platform'),
            'app_version' => Yii::t('app', 'App Version'),
            'system_version' => Yii::t('app', 'System Version'),
            'api_level' => Yii::t('app', 'Api Level'),
            'last_activity_action' => Yii::t('app', 'Last Activity Action'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessToken()
    {
        return $this->hasOne(OauthAccessTokens::class, ['access_token' => 'access_token']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefreshToken()
    {
        return $this->hasOne(OauthRefreshTokens::class, ['refresh_token' => 'refresh_token']);
    }

    /**
     * {@inheritdoc}
     * @return OauthSessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new OauthSessionQuery(get_called_class());
        return $query->active();
    }

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (in_array($this->scenario, [self::SCENARIO_DEFAULT])) {
                $this->platform = $this->platform ?: (Yii::$app->params['web'] ? self::PLATFORM_WEB : self::PLATFORM_MOBILE);
                $this->os = $this->os ?: ($this->platform == self::PLATFORM_WEB ? null : Yii::$app->params['os']);
                $this->app_version = $this->app_version ?: Yii::$app->params['version-name'];
                $this->ip_address = $this->ip_address ?: Yii::$app->request->userIP;
                $this->user_agent = $this->user_agent ?: Yii::$app->request->userAgent;
                $this->application = $this->application ?: (self::itemAlias('ClientToApp', $this->accessToken->client_id));
                $this->last_activity_action = $this->last_activity_action ?: Yii::$app->session->get('lastActivityAction');
            }

            return true;
        } else {
            return false;
        }
    }

    public function softDelete()
    {
        $this->scenario = self::SCENARIO_CHANGE_STATUS;
        $this->status = self::STATUS_DELETED;
        if ($this->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function terminate()
    {
        $this->scenario = self::SCENARIO_CHANGE_STATUS;
        $this->status = self::STATUS_TERMINATED;
        if ($this->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function restore()
    {
        $this->scenario = self::SCENARIO_CHANGE_STATUS;
        $this->status = self::STATUS_ACTIVE;
        if ($this->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_ACTIVE => Yii::t("app", "Active"),
                self::STATUS_TERMINATED => Yii::t("app", "Terminated"),
                self::STATUS_DELETED => Yii::t("app", "Deleted"),
            ],
            'Application' => [
                self::AVINOX_APP => 'Avinox',
                self::AVINOX_WEB => 'Avinox Web',
            ],
            'Platform' => [
                self::PLATFORM_WEB => 'Web',
                self::PLATFORM_MOBILE => 'Mobile'
            ],
            'Os' => [
                self::OS_ANDROID => 'Android',
                self::OS_IOS => 'iOS'
            ],
            'ClientToApp' => [
                'avinox' => self::AVINOX_APP,
                'avinox_web' => self::AVINOX_WEB,
            ],
            'AppToClient' => [
                self::AVINOX_APP => 'avinox',
                self::AVINOX_WEB => 'avinox_web',
            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at'
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => null,
                'updatedByAttribute' => 'updated_by'
            ],
        ];
    }
}