<?php

namespace common\models;

use common\components\Env;
use filsh\yii2\oauth2server\models\OauthClients;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\validators\NumberValidator;
use yii\validators\RegularExpressionValidator;
use common\components\Helper;

/**
 * Class LoginForm
 *
 * @property User $user
 * @property int $validTime
 */
class LoginForm extends Model
{
    const NUMBEROFFAIL = 5;
    const TIME_SEND_AGAIN_AFTER_FAIL = 600; // مدت زمان برای ارسال مجدد کد در صورت ارسال بیش از حد
    const VALIDTIME = 120;

    public $number;
    public $code;
    public $password;
    public $user;
    public $existUser = false;
    public $authenticator;
    const  SCENARIO_BY_PASSWORD_API = 'by-password-api';                          // Login by password
    const  SCENARIO_LOGIN_CODE_API = 'login-code-api';                            // ارسال کد تائید
    const  SCENARIO_VALIDATE_CODE_API = 'login-validate-api';                     // بررسی کد تائید
    const  SCENARIO_VALIDATE_CODE_PASSWORD_API = 'login-validate-code-password-api';                   // بررسی پسورد
    public $time_send_code;
    public $remind_valid_time;

    public function rules()
    {
        return [
            [['number'], 'required', 'on' => [self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_LOGIN_CODE_API,self::SCENARIO_VALIDATE_CODE_API,self::SCENARIO_VALIDATE_CODE_PASSWORD_API]],
            [['code'], 'required', 'on' => [ self::SCENARIO_LOGIN_CODE_API]],
            [['password'], 'required', 'on' => [ self::SCENARIO_VALIDATE_CODE_PASSWORD_API,]],
            ['rememberMe', 'boolean'],
            [['number'], 'match', 'pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/'],
            [['number'], 'validateUser', 'skipOnEmpty' => false, 'on' => [ self::SCENARIO_BY_PASSWORD_API,self::SCENARIO_LOGIN_CODE_API,]],
            [['password'], 'validatePassword', 'skipOnEmpty' => false, 'on' => [self::SCENARIO_VALIDATE_CODE_PASSWORD_API,]],
            [['code'], 'validateCode', 'skipOnEmpty' => false,
                'on' => [self::SCENARIO_LOGIN_CODE_API]
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_VALIDATE_CODE_PASSWORD_API] = ['number', 'password'];
        $scenarios[self::SCENARIO_BY_PASSWORD_API] = ['number'];
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

    public function validatePassword($attribute, $params)
    {
        if ($this->user != null) {
            if ((!$this->user->password ) || ($this->user->password && (!$this->password || !$this->user->validatePassword($this->password)))) {
                $this->addError($attribute, "کلمه عبور درست نیست.");
            }
        } else {
            $this->addError('number', "کاربری با شماره {$this->number} ثبت نشده است.");
            $this->addError('existUser', $this->existUser);
        }
    }
    public function validateFail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (Yii::$app->session->get('user.attempts-login', 0) > self::NUMBEROFFAIL && Yii::$app->session->get('user.attempts-login-time') > strtotime('-60 minutes')) {
                $this->addError($attribute, "تعداد دفعات ثبت اشتباه کلمه عبور بیش از حد مجاز است.لطفا بعدا سعی نمایید.");
            }
        }
    }
    public function checkLimit($attribute, $params)
    {
        $session = Yii::$app->session;

        if ($session->has("count_send")) {
            if ($session->get('count_send') >= 1 && $session->get('count_send') < 10) {
                if ($this->getTimeExpireCode() >= time() && Yii::$app->session->get("number") == $this->number) {
                    $this->addError($attribute, Yii::t('app', 'Wait {waitSeconds} seconds To send verify code!', ['waitSeconds' => ($this->getTimeExpireCode() - time())]));
                }
            }
            if ($session->get('count_send') > 10) {
                if ($session->get("first_time_send_code") + self::TIME_SEND_AGAIN_AFTER_FAIL >= time()) {
                    $session->remove("first_time_send_code"); // از مدت زمان تائین شده برای ارسال مجدد کد گذشته است.
                } else {
                    $this->addError($attribute, "تعداد دفعات ارسال کد بیش از حد مجاز است.لطفا بعدا سعی نمایید.");
                }
            }
        }
    }
    public function validateCode($attribute, $params)
    {
        $this->code = Yii::$app->customHelper->toEn($this->code);
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
        $verify = new UserVerify([
            'type' => UserVerify::TYPE_MOBILE_CONFIRMATION,
            'unhashedCode' => substr($this->number,-4),
            'phone' => $this->number,
            'fail' => 0,
            'expireTime' => $this->validTime,
        ]);
        if (($result = $verify->save()) === true){
            $this->time_send_code = $verify->created;
            $this->remind_valid_time = $verify->getRemindValidTime();
            return true;
        }else{
            return false;
        }

    }

    /** @inheritdoc */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $numberValidator = new RegularExpressionValidator(['pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/']);
            if (!$numberValidator->validate($this->number)) {
                $this->addError('number', Yii::t('app', 'Invalid Mobile Number'));
                return false;
            }
            $this->user = User::find()
                ->andWhere(['username' => $this->number])
                ->andWhere(['<>', 'status', User::STATUS_DELETED])
                ->one();
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
    public function beforeLogin()
    {
        return false;
    }
    public function afterLogin()
    {
        $login = Yii::$app->user->login($this->user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        return $login;
    }
    public function getValidTime()
    {
        return  self::VALIDTIME;
    }
    public function getTimeExpireCode()
    {
        return Yii::$app->session->get('time_send_code') + $this->validTime; //زمان اعتبار کد ارسال شده
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
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['invitor'], $fields['user'], $fields['verifyCode'],
            $fields['rememberMe'], $fields['code'], $fields['password'],
            $fields['password_repeat'], $fields['sendAgain'], $fields['captcha'],
            $fields['show_captcha']);

        return $fields;
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function sendrequest(LoginForm $model, $password)
    {
//        try {
            $client_id = Yii::$app->request->headers['client-id'];
            $oauth = OauthClients::find()->Where(['client_id' => $client_id])->one();
            $data = [
                'grant_type' => 'password',
                'client_id' => Yii::$app->request->headers['client-id'],
                'client_secret' => $oauth->client_secret,
                'username' => $model->number,
                'password' => json_encode($password,true),
            ];
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('http://api.ince.local/oauth2/rest/token')
                ->setData($data)
                ->send();
            $responseContent = json_decode($response->content);
            return [
                'success' => $response->isOk,
                'body' => $responseContent
            ];
//        } catch (\Exception $e) {
//            return  $e;
//        }
    }


}