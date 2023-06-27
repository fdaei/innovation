<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\httpclient\Exception;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;


/**
 * Security controller
 */
class SecurityController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
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
            $model->load(Yii::$app->request->post(), '');

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
    public function actionValidateLogin()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_API]);
        $model->load(Yii::$app->request->post(), '');
        if ($model->validate()) {
            $model->afterLogin();
            $password = ['type' => 'verifyCode', 'value' => $model->code];
            $token = $model->sendrequest($model, $password);
            return [
                'token' => $token,
                'identity' => $model->user
            ];
        }
        return $model;
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \Exception
     */
    public function actionValidateCodePassword()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD_API]);
        $model->load(Yii::$app->request->post(), '');
        if ($model->validate()) {
            $password = ['type' => 'pass', 'value' => $model->password];
            $model->afterLogin();
            $token = $model->sendrequest($model, $password);
            return [
                'token' => $token,
                'identity' => $model->user
            ];
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

    public function actionValidateRegister()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_VALIDATE_CODE_API]);
        $model->load(Yii::$app->request->post(), '');
        if ($model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $user = $model->save();
                if ($user) {
                    $transaction->commit();
                    $password = ['type' => 'verifyCode', 'value' => $model->code];
                    $response = $model->sendrequest($model, $password);
                    if ($response['success'] === true) {
                        return [
                            'token' => $response['body'] ,
                            'identity' => $user
                        ] ?? null;
                    } else {
                        throw new NotFoundHttpException(Yii::t('app', 'The requested was fail .'));
                    }

                } else {
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $model->setFailed();
        }

        return $model;
    }
}