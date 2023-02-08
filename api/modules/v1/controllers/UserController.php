<?php

namespace api\modules\v1\controllers;

use common\models\OauthAccessTokens;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

/**
 * BusinessController implements the CRUD actions for Business model.
 */
class UserController extends ActiveController
{
    public $modelClass = "common\models\User";

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    ['class' => HttpBearerAuth::class],
                    ['class' => QueryParamAuth::class, 'tokenParam' => 'accessToken'],
                ]
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::class
            ],
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['index'], $actions['create'], $actions['delete'], $actions['view'], $actions['update']);
        return $actions;

    }

    public function actionView()
    {
        return Yii::$app->user->identity;
    }

    public function actionLogout()
    {
        /**
         * @var OauthAccessTokens $currentAccessToken
         */
        $currentAccessToken = OauthAccessTokens::getCurrentAccessToken();
        $currentAccessToken->terminate();
        return Yii::$app->user->logout();
    }

}