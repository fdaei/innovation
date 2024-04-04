<?php

namespace backend\controllers;

use backend\models\UploadForm;
use common\components\AuthHandler;
use common\components\AsiaTechSmsService;
use common\models\ChangePassword;
use common\models\Comments;
use common\models\CommentsType;
use common\models\LoginForm;
use common\models\mongo\MGActivityTracking;
use common\models\OauthAccessTokens;
use common\models\User;
use common\models\voip\SimoTellModel;
use common\traits\AjaxValidationTrait;
use common\traits\CoreTrait;
use nextvikas\authenticator\components\Authenticator;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    use CoreTrait;
    use AjaxValidationTrait;

    /**a
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'login', 'error', 'captcha',
                            'forgot-password', 'validate-code-forgot-password',
                            'verify-code',
                            'auth', 'is-guest'
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['send-again'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'set-password', 'auth', 'change-password', 'captcha', 'report-bug','test-sms'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'google-auth', 'scan', 'check', 'disable', 'scale'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['upload'],
                        'allow' => true,
                        'roles' => ['admin', 'superadmin'],
                    ],
                    [
                        'actions' => ['price-crm', 'test-crm'],
                        'allow' => true,
                        'roles' => ['superadmin']
                    ],
                    [
                        'actions' => ['test'],
                        'allow' => true,
                        'roles' => ['superadmin']
                    ],
                    [
                        'actions' => ['debug'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ArrayHelper::isIn(Yii::$app->user->id, [15031]);
                        },
                    ],
                    [
                        'actions' => ['terminate-all'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ArrayHelper::isIn(Yii::$app->user->id, [15031, 90540, 91486]);
                        },
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'disable' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error',
                'view' => 'error'
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],//login
            ],
            'captcha' => [
                'class' => 'lubosdz\captchaExtended\CaptchaExtendedAction',
                // optionally, set mode and obfuscation properties e.g.:
                'mode' => 'math',
                //'resultMultiplier' => 5,
                //'lines' => 5,
                //'height' => 50,
                //'width' => 150,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (ArrayHelper::isIn($action->id, ['upload', 'debug'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /*
     * login with google
     */
    public function successCallback($client)
    {
        (new AuthHandler($client))->handle();
    }

    public function actionTest()
    {
        SimoTellModel::updateAll(['$set' => ['request_logs' => null]]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('dashboard')) {
            if (Yii::$app->user->identity->redirect) {
                return $this->redirect(Yii::$app->user->identity->redirect);
            }
            return $this->render('index');
        } else {
            if (Yii::$app->user->can('contentProducer')) {
                return $this->redirect(['/content']);
            } elseif (Yii::$app->user->can('funding')) {
                return $this->redirect(['/credit']);
            } else {
                return $this->redirect(['profile/index']);
            }
        }
    }


    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->request->post()) && $model->change()) {
            Yii::$app->session->setFlash('success', 'کلمه عبور با موفقیت تغییر کرد');
            return $this->redirect(['site/index']);
        }
        return $this->render('change_password', [
            'model' => $model
        ]);
    }

    public function actionUpload()
    {//برای ادیتور متن
        $model = new UploadForm();
        $model->upload = UploadedFile::getInstanceByName('upload');

        if (!empty($model->upload->extension)) {
            $pic_name = substr(time(), 4) . rand(1000, 99999) . '.' . $model->upload->extension;
            $model->upload->saveAs('upload/' . $pic_name);
            return Yii::$app->urlManager->createAbsoluteUrl('upload') . '/' . $pic_name;
        }
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $model = new LoginForm();
        $model->setScenario(LoginForm::SCENARIO_back_STEP_1);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPjax) {
            if ($model->validate() && $model->sendCode()) {
                Yii::$app->session->set("number", $model->number);
                Yii::$app->session->set('user.attempts-login', 0);//if login is successful, reset the attemps
                Yii::$app->session->set('user.returnUrl', Yii::$app->user->returnUrl);
                $model->show_captcha = false;

                return $this->renderAjax("_validate-code", [
                    'model' => $model,
                    'type' => Yii::$app->session->get('user.login_type')
                ]);
            } else {
                return $this->renderAjax("login", [
                    'model' => $model,
                    'alert' => null
                ]);
            }
        } else {
            return $this->render("login", [
                'model' => $model,
                'alert' => null
            ]);
        }
    }

    public function actionVerifyCode($type = null)
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }

        $model = new LoginForm([
            'rememberMe' => true,
            'number' => Yii::$app->session->get("number")
        ]);

        if ($type == null) {
            $type = Yii::$app->session->get('user.login_type', 'sms');
            $model->scenario = $type == 'sms' ? LoginForm::SCENARIO_back_STEP_2 : LoginForm::SCENARIO_STEP_2_GOOGLE;
        } else {
            Yii::$app->session->set('user.login_type', 'sms');
            $model->scenario = LoginForm::SCENARIO_back_STEP_2;
            if ($model->validate(['number'])) {
                $model->sendCode();
            } else {
                return $this->redirect(['login']);
            }
        }

        if (!$model->number || ($model->scenario == LoginForm::SCENARIO_back_STEP_2 && $model->getTimeExpireCode() < time())) {
            return $this->redirect(['login']);
        }

        $model->user = User::findByUsername($model->number);

        if ($model->load(Yii::$app->request->post())) {
            $platform = (Yii::$app->devicedetect->isMobile() || Yii::$app->devicedetect->isTablet()) ?
                User::ACCESS_POINT_MOBIT_BACKEND_WEB_MOBILE : User::ACCESS_POINT_MOBIT_BACKEND_WEB_DESKTOP;
            if ($model->validate() && $model->beforeLogin($platform)) {
                if (in_array($model->number, Yii::$app->params['autoLogin'])) {
                    Yii::$app->user->enableAutoLogin = true;
                }
                $model->afterLogin();
                MGActivityTracking::create(MGActivityTracking::MODEL_LOGIN_BACKEND, Yii::$app->user->id, 'لاگین بکند ' . Yii::$app->user->identity->username);
                return $this->redirect(Yii::$app->user->returnUrl);
            } else {
                $model->setFailed();
            }
            return $this->renderAjax("_validate-code", [
                'model' => $model,
                'type' => Yii::$app->session->get('user.login_type')
            ]);
        } else {
            return $this->render("_validate-code", [
                'model' => $model,
                'type' => Yii::$app->session->get('user.login_type')
            ]);
        }
    }

    /**
     * Forgot Password
     *
     * @return mixed
     */
    public function actionForgotPassword()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->user->returnUrl);
        }

        $this->layout = 'login';
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_FORGOT_PASSWORD_STEP_1]);

        if (Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendCode()) {
                    Yii::$app->session->set("number", $model->number);
                    $model->setScenario(LoginForm::SCENARIO_FORGOT_PASSWORD_STEP_2);
                    Yii::$app->session->set('user.attempts-login', 0);//if login is successful, reset the attempts
                    $model->show_captcha = false;

                    return $this->renderAjax("_validate-code-forgot-password", [
                        'model' => $model
                    ]);
                }
            }
            return $this->renderAjax("_forgot_password", [
                'model' => $model
            ]);
        }

        return $this->render("_forgot_password", [
            'model' => $model
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionValidateCodeForgotPassword()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->user->returnUrl);
        }

        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_FORGOT_PASSWORD_STEP_2]);
        if (!Yii::$app->session->get('number') || $model->getTimeExpireCode() < time()) {
            return $this->renderAjax("_forgot_password", [
                'model' => $model,
            ]);
        }
        $model->number = Yii::$app->session->get("number");

        if (Yii::$app->request->isPjax) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->setPassword()) {   //اگر کد فعال سازی درست بود.
                    $model = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD]);
                    return $this->render('login', [
                        'model' => $model,
                        'alert' => 'کلمه عبور شما تغییر یافت.'
                    ]);

                } else {
                    $model->setFailed();
                }
            }
            return $this->renderAjax("_validate-code-forgot-password", [
                'model' => $model,
            ]);
        }

        return $this->render("_validate-code-forgot-password", [
            'model' => $model,
        ]);
    }

    /**
     * @param bool $modal
     * @param string $scenario
     * @return string
     */
    public function actionSendAgain($scenario = LoginForm::SCENARIO_STEP_2)
    {
        $model = new LoginForm(['scenario' => $scenario]);
        $model->sendAgain();

        return $this->renderAjax(LoginForm::itemAlias('ScenarioToView', $scenario), [
            'model' => $model,
            'type' => Yii::$app->session->get('user.login_type')
        ]);
    }

    public function actionSetPassword()
    {
        $this->layout = 'login';
        $model = new LoginForm();
        $model->scenario = LoginForm::SCENARIO_SET_PASSWORD;
        $model->user = Yii::$app->user->identity;
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->setPassword()) {
            return $this->redirect(['site/index']);
        }
        return $this->render("set-password", ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if (in_array(Yii::$app->user->identity->username, Yii::$app->params['autoLogin'])) {
            Yii::$app->user->enableAutoLogin = true;
        }
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionIsGuest()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Yii::$app->user->isGuest;
    }

    public function actionGoogleAuth()
    {
        $this->layout = 'profile';
        return $this->render('_google_auth');
    }

    public function actionScan()
    {
        $Authenticator = new Authenticator();

        if (Yii::$app->request->isPost) {

            $checkResult = $Authenticator->verifyCode(Yii::$app->session->get('auth_secret'), Yii::$app->request->post('code'), 2);

            if (!$checkResult) {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Invalid Google Authenticator Code'));
                return $this->redirect(['/site/scan']);
            } else {

                $user = User::findOne(Yii::$app->user->identity->id);
                $user->authenticator = Yii::$app->session->get('auth_secret');
                $user->save(false);

                Yii::$app->session->set('varify_next_authenticator', true);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Google Authenticator Has Enabled'));
                return $this->redirect(['site/google-auth']);
            }
        }


        if (!Yii::$app->session->has('auth_secret')) {
            $secret = $Authenticator->generateRandomSecret();
            Yii::$app->session->set('auth_secret', $secret);
        }
        $qrCodeUrl = $Authenticator->getQR(Yii::$app->name . '(' . Yii::$app->user->identity->username . ')', Yii::$app->session->get('auth_secret'));

        if (User::findOne(Yii::$app->user->identity->id)->authenticator == null) {
            return $this->render('scan', ['qrCodeUrl' => $qrCodeUrl]);
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Google Authenticator Already Enabled'));
            return $this->redirect(['site/google-auth']);
        }

    }

    public function actionCheck()
    {
        $Authenticator = new Authenticator();

        if (Yii::$app->request->isPost) {
            $checkResult = $Authenticator->verifyCode(Yii::$app->user->identity->authenticator, Yii::$app->request->post('code'), 2);

            if (!$checkResult) {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Invalid Google Authenticator Code'));
                return $this->redirect(['/authenticator']);
            } else {
                Yii::$app->session->set('varify_next_authenticator', true);
                Yii::$app->session->setFlash('error', Yii::t('app', Yii::t('app', 'Google Authenticator Already Enabled')));
                return $this->redirect(['/authenticator']);
            }
        }
        return $this->redirect(['/authenticator']);
    }

    public function actionDisable()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->authenticator = null;
        $check = $user->save();

        if ($check) {
            Yii::$app->session->setFlash('warning', Yii::t('app', 'Google Authenticator Has Disabled'));
            return $this->redirect(['site/google-auth']);
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Error In Save Info'));
            return $this->redirect(['site/scan']);
        }
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function actionTerminateAll()
    {
        /**
         * @var OauthAccessTokens[] $apiSessionModels
         */
        $apiSessionModels = Yii::$app->user->identity
            ->getNotExpiredAccessTokens()
            ->joinWith('session')
            ->all();

        if (count($apiSessionModels) > 0) {
            $flag = true;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($apiSessionModels as $apiSessionModel) {
                    if (!$flag) {
                        break;
                    }
                    $flag = $apiSessionModel->terminate();
                }

                if ($flag) {
                    $transaction->commit();
                    echo "You Terminate All Sessions!";
                } else {
                    $transaction->rollBack();
                    echo "Error On Terminate All Sessions!";
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }

        return true;
    }


    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return $km;
    }

    /**
     * @param $title
     * @param $message
     * @param $url
     * @param $referrer
     * @return array|string
     * @throws Yii\base\ExitException
     */
    public function actionReportBug($title, $message, $url, $referrer = '')
    {
        $commentType = CommentsType::findOne(CommentsType::ERROR_REPORT);
        $model = new Comments();
        $model->setScenario(Comments::SCENARIO_REPORT_BUG);
        $model->title = $title;
        $model->css_class = Comments::TYPE_SUCCESS;
        $model->type_task = $commentType->id;
        $model->type = Comments::TYPE_PRIVATE;
        $result = [
            'success' => false,
            'msg' => Yii::t("app", "Error In Save Info")
        ];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach (is_array($commentType->users) ? $commentType->users : [] as $userId) {
                    /** @var User $user */
                    if (($user = User::findOne($userId)) !== null) {
                        $model->owner[] = $user->id;
                    }
                }
                $model->des .= '<hr/>';
                $model->des .= Html::tag('p', 'Error: ' . $message);
                $model->des .= '<hr/>';
                $model->des .= Html::tag('p', 'Url: ' . $url);
                $model->des .= Html::tag('p', 'Referrer: ' . $referrer);
                $flag = $model->save(false);
                $flag = $flag && $model->saveInbox();
                if ($flag && $commentType->sendSms) {
                    $model->sendSms();
                }
                if ($flag && $commentType->sendMail) {
                    $model->sendMail();
                }
                if ($flag) {
                    $result = [
                        'success' => true,
                        'msg' => Yii::t("app", "Item Created")
                    ];
                    $transaction->commit();
                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage() . $e->getTraceAsString(), Yii::$app->controller->id . '/' . Yii::$app->controller->action->id);
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $result;
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_report-bug', [
            'model' => $model,
        ]);
    }

    public function actionTestSms()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            $smsService = new AsiaTechSmsService();
            $Result = $smsService->sendTemplate("09376221902","123456","638434165675025699");

            if ($Result['status']) {
                \Yii::info("SMS sent successfully. Response: " . json_encode($Result['body']));
                return [
                    'success' => true,
                    'message' => "SMS sent successfully.",
                    'response' => $Result['body']
                ];
            } else {
                \Yii::error("Failed to send SMS. Error: " . $Result['error']);
                return [
                    'success' => false,
                    'message' => "Failed to send SMS.",
                    'error' => $Result['error']
                ];
            }
        } catch (\Exception $e) {
            \Yii::error("Exception caught while trying to send SMS: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Exception caught while trying to send SMS.",
                'error' => $e->getMessage()
            ];
        }
    }
}