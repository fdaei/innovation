<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use frontend\models\SignupForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'profile', 'update-profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_back_STEP_1]);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionProfile()
    {
        $model = Yii::$app->user->identity;
        return $this->render('profile', ['model' => $model]);
    }

    public function actionUpdateProfile($id)
    {
        $model = new SignupForm();
        $old = User::findOne($id);
        $model->username = $old->username;
        $model->email = $old->email;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $old->username=$model->username;
            $old->email=$model->email;
            if ($model->password) {
                $old->password=$model->password;
            }
            $old->save();
            return $this->render('profile', [
                'model' => $model,
            ]);
        }

        return $this->render('update_profile', [
            'model' => $model,
        ]);
        $oldmodel = SignupForm::findModel($id);
    }
}