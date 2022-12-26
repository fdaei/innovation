<?php

namespace api\modules\v1\controllers;

use common\components\Env;
use common\models\LoginForm;
use common\models\User;
use common\models\UserVerify;
use filsh\yii2\oauth2server\models\OauthClients;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\rest\ActiveController;


/**
 * Site controller
 */
class SecurityLoginController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $serializer = [
        'class'              => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), []);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['options']);
        return $actions;
    }

    protected function verbs()
    {
        return [
            'Login' => ['POST', 'OPTIONS'],
            'ValidateCodeRegisterLogin' => ['POST', 'OPTIONS'],
            'ValidateCodePassword' => ['POST', 'OPTIONS'],
            'ValidateCodeRegister' => ['POST', 'OPTIONS'],
            'Register' => ['POST', 'OPTIONS'],
        ];
    }


    public function actionLogin($login_by_code = true)
    {
        if ($login_by_code) {
            $model = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN_CODE_API]);
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $model->sendCode();
            }
        } else {
            $model = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD_API]);
            $model->load(Yii::$app->request->post());
            $model->validate();
        }
        return $model;
    }


    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionValidateCodeRegisterLogin()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_API]);
        $model->load(Yii::$app->request->post());
        if($model->validate()){
            $identity = User::findOne(['username' => $model->number]);
            Yii::$app->user->login($identity);
            $password = ['type' => 'verifyCode','value' => $model->code];
            return $model->sendrequest($model,$password);
        }
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionValidateCodePassword()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD_API]);
        $model->load(Yii::$app->request->post());
        if($model->validate()){
            $password = ['type' => 'pass', 'value' => $model->password];
            $identity = User::findOne(['username' => $model->number]);
            Yii::$app->user->login($identity);
            return $model->sendrequest($model, $password);
        }
    }

    public function actionValidateCodeRegister()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_API]);
        $model->load(Yii::$app->request->post(), '');
        if ($model->validate()) {   //اگر کد فعال سازی درست بود.
            $model->save();
            $password = ['type' => 'verifyCode','value' => $model->code];
            return $model->sendrequest($model,$password);
        } else {
            $model->setFailed();
        }
        return $model;
    }
    public function actionRegister()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_REGISTER_API_STEP_1]);
        $model->load(Yii::$app->request->post(), '');
        if ($model->validate()) {
            $model->sendCode(LoginForm::CODE_LENGTH_API);
        }
        return $model;
    }
}