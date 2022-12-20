<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use filsh\yii2\oauth2server\controllers\RestController;
use filsh\yii2\oauth2server\models\OauthClients;
use Yii;
use yii\filters\VerbFilter;
use yii\httpclient\Client;

/**
 * Site controller
 */
class LoginController extends RestController
{
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

                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['index'], $actions['create'], $actions['delete'], $actions['view'], $actions['update']);
        return $actions;
    }

    public function actionLogin($login_by_code = true)
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
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_API]);

        $model->load(Yii::$app->request->post());

        if ($model->validate()) {

        }
    }

    public function actionValidateCodePassword()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_PASSWORD_API]);

        $model->load(Yii::$app->request->post());

        if ($model->validate()) {

        }
    }
}