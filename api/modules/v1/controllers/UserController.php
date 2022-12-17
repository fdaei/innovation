<?php

namespace api\modules\v1\controllers;

use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\HttpException;


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

// TODO unset Create, Update, Delete actions

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['index'], $actions['create'], $actions['delete'], $actions['view'], $actions['update']);
        return $actions;

    }

    /**
     * @OA\Info(
     *   version="1.0.0",
     *   title="My API",
     *   @OA\License(name="MIT"),
     *   @OA\Attachable()
     * )
     */
    /**
     * @OA\Get(
     *    path = "/user/authorize",
     *    tags = {"authorize"},
     *    operationId = "authorize",
     *    summary = "http://api.ince.local/v1/site/authorize",
     *    description = "Shttp://api.ince.local/v1/site/authorize",
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */
    public function actionAuthorize()
    {
        if (Yii::$app->getUser()->getIsGuest())
        {
            return $this->redirect('login');
        }
        /** @var $module \filsh\yii2\oauth2server\Module */
        $module = Yii::$app->getModule('oauth2');
        $response = $module->getServer()->handleAuthorizeRequest(null, null, !Yii::$app->getUser()->getIsGuest(), Yii::$app->getUser()->getId());
        /** @var object $response \OAuth2\Response */
        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
        return $response->getParameters();
    }
}