<?php

namespace common\models;

use common\components\Env;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\validators\NumberValidator;
use yii\validators\RegularExpressionValidator;
use common\components\Helper;

/**
 * Class LoginForm
 *
 * @property User $user
 */
class LoginForm extends Model
{
    public $number;
    public $code;
    public $password;
    public $user;
    public $existUser = false;
    public $isSetPassword = false;
    public $authenticator;
    const  SCENARIO_BY_PASSWORD_API = 'by-password-api';                          // Login by password
    const  SCENARIO_LOGIN_CODE_API = 'login-code-api';                            // ارسال کد تائید
    const  SCENARIO_VALIDATE_CODE_API = 'login-validate-api';                     // بررسی کد تائید

    public function rules()
    {
        return [
            [['number'], 'required', 'on' => [self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_LOGIN_CODE_API,self::SCENARIO_VALIDATE_CODE_API,]],
            [['code'], 'required', 'on' => [ self::SCENARIO_VALIDATE_CODE_API]],
            [['password'], 'required', 'on' => [ self::SCENARIO_BY_PASSWORD_API,]],
            ['rememberMe', 'boolean'],
            [['number'], 'match', 'pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/'],
            [['number'], 'validateUser', 'skipOnEmpty' => false, 'on' => [ self::SCENARIO_BY_PASSWORD_API,self::SCENARIO_LOGIN_CODE_API,]],
            [['password'], 'validatePassword', 'skipOnEmpty' => false, 'on' => [self::SCENARIO_BY_PASSWORD_API,]],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_BY_PASSWORD_API] = ['number', 'password'];
        $scenarios[self::SCENARIO_LOGIN_CODE_API] = ['number'];
        $scenarios[self::SCENARIO_VALIDATE_CODE_API] = ['number', 'code'];
        return $scenarios;
    }


    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', 'Mobile Number'),
            'code' => Yii::t('app',  'Verify Code'),
            'rememberMe' => Yii::t('app', 'RememberMe'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    public function validateUser($attribute, $params)
    {
        if (ArrayHelper::isIn($this->scenario, [ self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_LOGIN_CODE_API]) && $this->user == null) {
            $this->addError($attribute, "کاربری با شماره {$this->number} ثبت نشده است.");
            $this->addError('existUser', $this->existUser);
        }
    }
    public function validateCode($attribute, $params)
    {
        $this->code = Yii::$app->helper->toEn($this->code);
        if (!$this->hasErrors()) {
            $model = UserVerify::find()
                ->andWhere([
                    'phone' => $this->number,
                    'type' => UserVerify::TYPE_MOBILE_CONFIRMATION
                ])->one();
            if ($model === null || !Yii::$app->security->validatePassword($this->code, $model->code)) {
                $this->addError($attribute, 'کد وارد شده اشتباه است.');
            } else {
                $model->expireTime = $this->validTime;
                if (!$model->isExpired) {
                    if (!ArrayHelper::isIn($this->getScenario(), [self::SCENARIO_VALIDATE_CODE_API])) {
                        $model->delete();
                    }
                    $session = Yii::$app->session;
                    $session->remove('time_send_code');
                } else {
                    $this->addError($attribute, "کد تایید منقضی شده است");
                }
            }
        }
    }


    /**
     * ارسال کد تائید
     * و ذخیره در دیتا بیس
     */
    public function sendCode()
    {
        return true;
    }

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            var_dump($this->number);
            $numberValidator = new RegularExpressionValidator(['pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/']);
            $intValidator = new NumberValidator(['integerOnly' => true, 'skipOnEmpty' => true]);
            if (!$numberValidator->validate($this->number)) {
                $this->addError('number', Yii::t('app', 'Invalid Mobile Number'));
                return false;
            }
            $this->user = User::find()
                ->andWhere(['username' => $this->number])
                ->andWhere(['<>', 'status', User::STATUS_DELETED])
                ->one();
            if ($this->user instanceof User && ArrayHelper::isIn($this->scenario, [self::SCENARIO_LOGIN_CODE_API, self::SCENARIO_VALIDATE_CODE_API])) {
                $this->existUser = true;
                if ($this->user->password) {
                    $this->isSetPassword = true;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterValidate()
    {
        if ($this->hasErrors()) {
            Yii::$app->session->set('user.attempts-login', Yii::$app->session->get('user.attempts-login', 0) + 1);
        }
        parent::afterValidate();
    }

    public function setFailed()
    {
        $verifyNumber = UserVerify::find()
            ->andWhere([
                'phone' => $this->number,
                'type' => UserVerify::TYPE_MOBILE_CONFIRMATION
            ])->one();
        if ($verifyNumber) {
            $verifyNumber->fail += 1;
            $verifyNumber->save(true, ['fail']);
        }
    }

    public function setSessionFailed()
    {
        $verifyNumber = UserVerify::find()
            ->andWhere([
                'phone' => $this->number,
                'type' => UserVerify::TYPE_MOBILE_CONFIRMATION
            ])->one();
        if ($verifyNumber) {
            $verifyNumber->fail += 1;
            $verifyNumber->save(true, ['fail']);
        }
    }


    /**
     * @param $platform
     * @return bool
     * @throws \Exception
     */
    public function save($platform)
    {
        $user = new User();
        $user->username = $this->number;
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->setPassword($this->password);

    }

}