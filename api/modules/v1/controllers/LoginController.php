<?php

namespace api\modules\v1\controllers;

use common\components\Env;
use common\models\LoginForm;
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


    public function actionValidateCode()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN_CODE_API]);
        $model->load(Yii::$app->request->post());
        $password = ['type' => 'code', 'password' => UserVerify::find()->andWhere(['phone' => $model->number, 'type' => UserVerify::TYPE_MOBILE_CONFIRMATION])->one()['code']];
        return $this->extracted($model, $password);
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionValidateCodePassword()
    {
        $model = new LoginForm(['scenario' => LoginForm::SCENARIO_BY_PASSWORD_API]);
        $password = ['type' => 'password', 'password' => $model->password];
        return $this->extracted($model, $password);
    }

    /**
     * @param LoginForm $model
     * @return array
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function extracted(LoginForm $model, $password)
    {
        $client_id = Yii::$app->request->headers['client-id'];
        $oauth = OauthClients::find()->Where(['client_id' => $client_id])->one();

        $data = [
            'grant_type' => 'password',
            'client_id' => Yii::$app->request->headers['client-id'],
            'client_secret' => $oauth->client_secret,
            'username' => $model->number,
            'password' => json_encode($password),
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
    }
}