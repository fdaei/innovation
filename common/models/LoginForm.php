<?php

namespace common\models;

use common\components\Env;
use common\components\MobitApi;
use filsh\yii2\oauth2server\models\OauthClients;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\validators\RegularExpressionValidator;


/**
 * Class LoginForm
 *
 * @property User $user
 * @property int $validTime
 */
class LoginForm extends Model
{
    public $number;
    public $code;
    public $password;
    public $user;
    public $existUser = false;
    public $authenticator;
    public $time_send_code;
    public $remind_valid_time;
    public $token;
    public $rememberMe = false;
    public $captcha;
    public $show_captcha = false;
    public $sendAgain = false;
    public $identity = null;
    public $isSetPassword = false;

    const VALIDTIME = 120;
    const NUMBEROFFAIL = 5;
    const NUMBER_OF_SHOW_CAPTCHA = 3;
    const CODE_LENGTH_API = 4;
    const TIME_SEND_AGAIN_AFTER_FAIL = 1; // مدت زمان برای ارسال مجدد کد در صورت ارسال بیش از حد

    const  SCENARIO_BY_PASSWORD_API = 'by-password-api';                          // Login by password
    const  SCENARIO_SET_PASSWORD = 'set-password';                                // Set new password
    const  SCENARIO_LOGIN_CODE_API = 'login-code-api';                            // ارسال کد تائید
    const  SCENARIO_VALIDATE_CODE_API = 'login-validate-api';                     // بررسی کد تائید
    const  SCENARIO_VALIDATE_CODE_PASSWORD_API = 'login-validate-code-password-api';                   // بررسی پسورد
    const  SCENARIO_FORGOT_PASSWORD_API_STEP_1 = 'forgot-password-api-1';         // Forgot password (send verify code)
    const  SCENARIO_FORGOT_PASSWORD_API_STEP_2 = 'forgot-password-api-2';         // Forgot password (Verification & change password)
    const  SCENARIO_LOGIN_OR_REGISTER_API_STEP_1 = 'login-or-register-api-step-1';// ارسال کد تائید
    const  SCENARIO_REGISTER_API_STEP_1 = 'register-api-step-1';                  // Send verify code
    const  SCENARIO_REGISTER_API_STEP_2 = 'register-api-step-2';                  // Verification & Register new user
    const  SCENARIO_back_STEP_1 = 'back-step1';                                   // Send verify code
    const  SCENARIO_back_STEP_2 = 'back-step2';                                   // Validate code and password

    public function rules()
    {
        return [
            [['number'], 'required',
                'on' => [
                    self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_REGISTER_API_STEP_2,
                    self::SCENARIO_LOGIN_CODE_API, self::SCENARIO_LOGIN_OR_REGISTER_API_STEP_1, self::SCENARIO_VALIDATE_CODE_API, self::SCENARIO_REGISTER_API_STEP_1, self::SCENARIO_back_STEP_2,
                    self::SCENARIO_FORGOT_PASSWORD_API_STEP_1, self::SCENARIO_FORGOT_PASSWORD_API_STEP_2, self::SCENARIO_VALIDATE_CODE_PASSWORD_API, self::SCENARIO_back_STEP_1
                ]
            ],
            [['code'], 'required', 'on' => [
                self::SCENARIO_VALIDATE_CODE_API, self::SCENARIO_FORGOT_PASSWORD_API_STEP_2, self::SCENARIO_REGISTER_API_STEP_2, self::SCENARIO_back_STEP_2
            ]
            ],
            [['password'], 'required', 'on' => [self::SCENARIO_SET_PASSWORD,
                self::SCENARIO_BY_PASSWORD_API,
                self::SCENARIO_FORGOT_PASSWORD_API_STEP_2,
                self::SCENARIO_VALIDATE_CODE_PASSWORD_API,
                self::SCENARIO_REGISTER_API_STEP_2,
                self::SCENARIO_back_STEP_1,
            ]
            ],
            [['number', 'code'], 'filter', 'filter' => [$this, 'normalizeNumber']],
            ['rememberMe', 'boolean'],
            [['number'], 'filter', 'filter' => function ($number) {
                return Yii::$app->customHelper->toEn($number);
            }],
            [['number'], 'match', 'pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/'],
            [['number'], 'serviceUnavailable', 'when' => function (self $model) {
                return Env::get('SERVICE_UNAVAILABLE');
            }],
            [['number'], 'validateUser', 'skipOnEmpty' => false,
                'on' => [
                    self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_REGISTER_API_STEP_1,
                    self::SCENARIO_LOGIN_CODE_API, self::SCENARIO_LOGIN_OR_REGISTER_API_STEP_1, self::SCENARIO_back_STEP_1
                ]
            ],
            [['number'], 'checkLimit', 'skipOnEmpty' => false,
                'on' => [
                    self::SCENARIO_LOGIN_CODE_API, self::SCENARIO_LOGIN_OR_REGISTER_API_STEP_1,
                    self::SCENARIO_FORGOT_PASSWORD_API_STEP_1, self::SCENARIO_REGISTER_API_STEP_1, self::SCENARIO_back_STEP_1
                ]
            ],
            [['password'], 'validatePassword', 'skipOnEmpty' => false, 'on' => [self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_VALIDATE_CODE_PASSWORD_API, self::SCENARIO_back_STEP_1]],

            [['password'], 'match', 'pattern' => '/^[A-Za-z\d@$!%*#?^&~]{6,}$/', 'on' => [self::SCENARIO_SET_PASSWORD,
                self::SCENARIO_REGISTER_API_STEP_2,
                self::SCENARIO_FORGOT_PASSWORD_API_STEP_2,
                self::SCENARIO_VALIDATE_CODE_PASSWORD_API,
            ], 'message' => "کلمه عبور باید حداقل ۶ حرف و از الفبای انگلیسی و اعداد تشکیل شده باشد."
            ],
            [['password'], 'string', 'min' => 6, 'max' => 72, 'skipOnEmpty' => false, 'on' => [
                self::SCENARIO_SET_PASSWORD,
                self::SCENARIO_FORGOT_PASSWORD_API_STEP_2,
                self::SCENARIO_VALIDATE_CODE_PASSWORD_API,
                self::SCENARIO_REGISTER_API_STEP_2,
            ]],
            [['code'], 'validateCode', 'skipOnEmpty' => false,
                'on' => [
                    self::SCENARIO_VALIDATE_CODE_API, self::SCENARIO_FORGOT_PASSWORD_API_STEP_2, self::SCENARIO_REGISTER_API_STEP_2, self::SCENARIO_back_STEP_2
                ]
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SET_PASSWORD] = ['password'];
        $scenarios[self::SCENARIO_BY_PASSWORD_API] = ['number', 'password'];
        $scenarios[self::SCENARIO_LOGIN_CODE_API] = ['number'];
        $scenarios[self::SCENARIO_LOGIN_OR_REGISTER_API_STEP_1] = ['number'];
        $scenarios[self::SCENARIO_VALIDATE_CODE_API] = ['number', 'code'];
        $scenarios[self::SCENARIO_FORGOT_PASSWORD_API_STEP_1] = ['number'];
        $scenarios[self::SCENARIO_FORGOT_PASSWORD_API_STEP_2] = ['!number', 'code', 'password'];
        $scenarios[self::SCENARIO_REGISTER_API_STEP_1] = ['number', 'password'];
        $scenarios[self::SCENARIO_REGISTER_API_STEP_2] = ['number', 'code', 'password'];
        $scenarios[self::SCENARIO_back_STEP_1] = ['number', 'password', '!rememberMe',];
        $scenarios[self::SCENARIO_back_STEP_2] = ['!number', 'code', '!rememberMe', 'password'];

        return $scenarios;
    }


    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', 'Mobile Number'),
            'code' => Yii::t('app', 'Verify Code'),
            'rememberMe' => Yii::t('app', 'RememberMe'),
            'captcha' => Yii::t('app', 'Captcha'),
            'password' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app', 'Password Repeat')
        ];
    }

    public function serviceUnavailable($attribute, $params)
    {
        $this->addError($attribute, "Service Unavailable");
    }

    public function validateUser($attribute, $params)
    {
        if (ArrayHelper::isIn($this->scenario, [self::SCENARIO_BY_PASSWORD_API, self::SCENARIO_LOGIN_CODE_API, self::SCENARIO_back_STEP_1]) && $this->user == null) {
            $this->addError($attribute, "کاربری با شماره {$this->number} ثبت نشده است.");
            $this->addError('existUser', $this->existUser);
        }
        if (ArrayHelper::isIn($this->scenario, [self::SCENARIO_REGISTER_API_STEP_1]) && $this->user != null) {
            $this->addError($attribute, "کاربری با شماره {$this->number} قبلا ثبت شده است.");
            $this->existUser = true;
            $this->addError('existUser', $this->existUser);
        }

    }

    public function normalizeNumber($value)
    {
        return Yii::$app->customHelper->toEn($value);
    }


    public function validatePassword($attribute, $params)
    {
        if ($this->user != null) {
            if ((!$this->user->password_hash && $this->scenario != self::SCENARIO_back_STEP_1) || ($this->user->password_hash && (!$this->password || !$this->user->validatePassword($this->password)))) {
                $this->addError($attribute, "کلمه عبور درست نیست.");
            }
        } else {
            $this->addError('number', "کاربری با شماره {$this->number} ثبت نشده است.");
            $this->addError('existUser', $this->existUser);
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
                ])
                ->orderBy(['id' => SORT_DESC])
                ->one();
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
        $this->setSessions();
        $otpCode = rand(1000, 9999);

        try {
            $smsResult = MobitApi::sendSmsLogin($this->number, $otpCode);
            if ($smsResult !== true) {
                $this->addError('number', $smsResult);
                return false;
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage() . PHP_EOL . $e->getTraceAsString(), 'Exception/LoginSendCode');
            $this->addError('number', 'خطا در ارسال کد تائید. لطفا مجددا سعی نمایید.');
            return false;
        }

        $verify = new UserVerify([
            'type' => UserVerify::TYPE_MOBILE_CONFIRMATION,
            'unhashedCode' => $otpCode,
            'phone' => $this->number,
            'fail' => 0,
            'expireTime' => $this->validTime,
        ]);

        if ($verify->save()) {
            $this->time_send_code = $verify->created;
            $this->remind_valid_time = $verify->getRemindValidTime();
            return true;
        } else {
            return false;
        }
    }

    public function setSessions()
    {
        $session = Yii::$app->session;
        $session->set('time_send_code', $this->time_send_code); // زمان برای تایمر

        if (!$session->has("first_time_send_code")) {
            $session->set('first_time_send_code', $this->time_send_code); // زمان ارسال اولین sms
        }

        if ($session->has("count_send")) {
            $session->set("count_send", $session->get("count_send") + 1);
        } else {
            $session->set('count_send', 1);
        }
    }

    public function sendAgain($api = false)
    {
        $session = Yii::$app->session;
        $this->number = $api ? $this->number : $session->get("number");
        $this->user = User::findByUsername($this->number);
        if ($session->has('hashCode') && ($model = UserVerify::find()
                ->andWhere([
                    'phone' => $this->number,
                    'type' => UserVerify::TYPE_MOBILE_CONFIRMATION
                ])->one()) !== null) {
            try {
                $this->time_send_code = time();
                $model->created = $this->time_send_code;
                $model->unhashedCode = $session->get('hashCode');
                $model->expireTime = $this->validTime;
                $model->save();
                $this->remind_valid_time = $model->getRemindValidTime();
                $this->sendAgain = true;
                $session->remove('hashCode');
                $session->set('time_send_code', $this->time_send_code); // زمان برای تایمر
                return true;
            } catch (\Exception $e) {
                Yii::error($e->getMessage(), 'LoginFormSendAgain-Exception');
                $this->addError('number', 'خطا در ارسال کد تائید.لطفا بعدا مجددا سعی نمایید.');
            }
        } else {
            $this->addError('number', 'خطا در ارسال مجدد کد تائید.');
        }

        return false;
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $number = $this->normalizeNumber($this->number);
            $numberValidator = new RegularExpressionValidator(['pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/']);
            if (!$numberValidator->validate($number)) {
                $this->addError('number', Yii::t('app', 'Invalid Mobile Number'));
                return false;
            }

            $this->user = User::find()
                ->andWhere(['username' => $number])
                ->andWhere(['<>', 'status', User::STATUS_DELETED])
                ->one();


            if ($this->user instanceof User && ArrayHelper::isIn($this->scenario, [self::SCENARIO_LOGIN_CODE_API, self::SCENARIO_VALIDATE_CODE_API, self::SCENARIO_back_STEP_1])) {
                $this->existUser = true;
                if ($this->user->password_hash) {
                    $this->isSetPassword = true;
                }
            }

            return true;
        } else {
            return false;
        }
    }

    /** @inheritdoc */
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
     * @param int $platform
     * @param null $invitor
     * @return bool
     * @throws \Exception
     */
    public function beforeLogin()
    {
        if ($this->user !== null) {
            return $this->user->save(false);
        } else if (ArrayHelper::isIn($this->scenario, [self::SCENARIO_VALIDATE_CODE_API])) {
            return $this->save();
        }

        return false;
    }

    public function afterLogin()
    {
        $login = Yii::$app->user->login($this->user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        Yii::$app->user->returnUrl = Yii::$app->session->get('user.returnUrl');
        Yii::$app->session->remove('count_send');
        Yii::$app->session->remove('user.attempts-login');
        Yii::$app->session->remove('user.attempts-login-time');

        return $login;
    }

    public function afterLoginApi()
    {
        Yii::$app->session->remove('count_send');
        Yii::$app->session->remove('user.attempts-login');
        Yii::$app->session->remove('user.attempts-login-time');
    }

    public function getValidTime()
    {

        return ArrayHelper::isIn(Yii::$app->id, ['app-pay']) ? 300 : self::VALIDTIME;
    }

    public function getTimeExpireCode()
    {
        return Yii::$app->session->get('time_send_code') + $this->validTime; //زمان اعتبار کد ارسال شده
    }

    /**
     * @param $platform
     * @param $invitor
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        $user = new User();
        $user->username = $this->number;
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();
        $user->save();
        return $user;
    }

    public function setPassword()
    {
        $user = $this->user ?: Yii::$app->user->identity;
        if ($user instanceof User) {
            $user->setPassword($this->password);
            return $user->save(false);
        }

        return false;
    }

    public function getPassword(): bool
    {
        return true;
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [

        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['user'], $fields['verifyCode'],
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
        try {
            $client_id = Yii::$app->request->headers['client-id'];
            $oauth = OauthClients::find()->Where(['client_id' => $client_id])->one();
            $data = [
                'grant_type' => 'password',
                'client_id' => $client_id,
                'client_secret' => $oauth?->client_secret,
                'username' => $model->number,
                'password' => json_encode($password, true),
            ];
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl(Env::get('API_BASE_URL') . '/oauth2/rest/token')
                ->setData($data)
                ->send();
            $responseContent = json_decode($response->content);
            return [
                'success' => $response->isOk,
                'body' => $responseContent
            ];
        } catch (\Exception $e) {
            Yii::error($e->getMessage() . PHP_EOL . $e->getTraceAsString(), 'Exception/LoginForm-SendRequest');
            return [
                'success' => false,
                'body' => $e->getMessage()
            ];
        }
    }

    /**
     * @throws \Exception
     */
    public function login()
    {
        $this->beforeLogin();
        if ($this->validate()) {
            $flag = Yii::$app->user->login($this->user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            $this->afterLogin();
            return $flag;
        }
        return false;
    }

    public function setNumber(string $string)
    {
        $this->number = $string;
    }

    public function setCode(string $string)
    {
        $this->code = $string;
    }
}