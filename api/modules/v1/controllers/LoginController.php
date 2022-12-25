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
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\rest\ActiveController;


/**
 * Site controller
 */
class LoginController extends ActiveController
{
    public $modelClass = "common\models\User";
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'login' => 'GET', 'HEAD', 'OPTIONS',
                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['create'], $actions['delete'], $actions['view'], $actions['update']);
        return $actions;
    }

    public function actionSecurityLogin($login_by_code = true)
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
    public function actionValidateCode()
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
}