<?php

namespace api\modules\v1\controllers;
use common\models\LoginForm;
use filsh\yii2\oauth2server\models\OauthClients;
use Yii;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\rest\ActiveController;
use yii\rest\Controller;

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
                        'login'=>'GET', 'HEAD', 'OPTIONS',
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

    public function actionLoginForm($login_by_code = true)
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->post());
        if ($model->validate()) {
            if ($login_by_code) {
                $model->sendCode();
            }
        }
        return $model;
    }

    public function actionValidateCode()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD_API]);
        $model->load(Yii::$app->request->post());
        if($model->validate()){

        };
        return true;
    }

    public function actionValidateCodePassword()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN_CODE_API]);
        $model->load(Yii::$app->request->post());
        if ($model->validate()){

        };
        return true;
    }
}