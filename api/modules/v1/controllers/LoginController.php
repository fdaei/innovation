<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
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

    public function actionLoginForm($login_by_code = true)
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

    public function actionValidateCode()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_API]);
        $model->load(Yii::$app->request->post());
        if ($model->validate()) {

        }
        return true;
    }

    public function actionValidateCodePassword()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_PASSWORD_API]);
        $model->load(Yii::$app->request->post());
        if ($model->validate()) {

        }
        return true;
    }
}