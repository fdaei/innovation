<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%user_verify}}".
 *
 * @property string $phone
 * @property integer $type
 * @property string $code
 * @property string $unhashedCode
 * @property int $is_verify
 * @property integer $created
 * @property string $ip
 * @property integer $fail
 * @property bool $isExpired
 * @property integer $remindValidTime
 * @property integer $expirationTime
 * @property integer $expireTime
 *
 * @property user $user
 */
class UserVerify extends \yii\db\ActiveRecord
{
    const NO = 0;
    const YES = 1;

    const TYPE_MOBILE_CONFIRMATION = 1;
    const TYPE_CONFIRM_NEW_MOBILE = 2;
    const TYPE_REVERT_NEW_MOBILE = 3;

    const EXPIRATION_TIME = 120; // 2 Min

    public $unhashedCode;
    public $expireTime;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_verify}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'code', 'type'], 'required'],
            [['created', 'is_verify', 'type'], 'integer'],
            ['type', 'in', 'range' => array_keys(self::itemAlias('Type'))],
            [['phone'], 'string', 'max' => 12, 'min' => 11],
            [['phone'], 'match', 'pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/'],
            [['ip'], 'string', 'max' => 64],
            [['phone', 'code'], 'unique', 'targetAttribute' => ['phone', 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Phone',
            'code' => 'Code',
            'created' => 'Created',
            'ip' => 'Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['username' => 'phone']);
    }

    /**
     * @inheritdoc
     * @return UserVerifyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserVerifyQuery(get_called_class());
    }

    /**
     * ذخیره یا بروز رسانی
     */
    public function saveOrUpdate()
    {
        $model = self::find()->andWhere([
            'phone' => $this->phone,
            'type' => self::TYPE_MOBILE_CONFIRMATION
        ])->one();
        if ($model === null) {
            $this->is_verify = self::NO;
            return $this->save();
        } else {
            if (!$model->isExpired) {
                $model->addError('mobile', Yii::t('app', 'Wait {waitSeconds} seconds To send verify code!', ['waitSeconds' => $model->remindValidTime]));
                return $model;
            } else {
                if (isset($this->fail)) {
                    $model->fail = $this->fail;
                }
                $model->is_verify = self::NO;
                $model->unhashedCode = $this->unhashedCode;
                $model->created = time();
                $flag = $model->save();
                $this->created = $model->created;
                return $flag;
            }
        }
    }

    public function getExpirationTime()
    {
        return $this->expireTime ?: self::EXPIRATION_TIME;
    }

    /**
     * @return bool Whether token has expired.
     */
    public function getIsExpired()
    {
        return ($this->created + $this->expirationTime) < time();
    }

    /**
     * @return integer Token remind valid time.
     */
    public function getRemindValidTime()
    {
        return $this->isExpired ? 0 : ($this->created + $this->expirationTime) - time();
    }

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->code = $this->unhashedCode;

            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            Yii::$app->session->set('hashCode', $this->unhashedCode);
            $this->setAttribute('created', time());
            $this->setAttribute('code', Yii::$app->security->generatePasswordHash($this->unhashedCode));
            $this->ip = Yii::$app->request->getUserIP();
            return true;
        }
        return false;
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Type' => [
                self::TYPE_MOBILE_CONFIRMATION => Yii::t("app", "Mobile Confirmation"),
                self::TYPE_CONFIRM_NEW_MOBILE => Yii::t("app", "New Mobile Confirmation"),
                self::TYPE_REVERT_NEW_MOBILE => Yii::t("app", "Revert New Mobile Confirmation"),
            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public function setName(string $string)
    {
        $this->phone = $string;
    }

    public function getName()
    {
        return $this->phone;
    }
}