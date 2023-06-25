<?php

namespace api\modules\v1\controllers;

use common\models\EventAttendance;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class EventAttendanceController extends ActiveController
{
    public $modelClass = "common\models\EventAttendance";
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
                ],
                'optional' => ['create']
            ],
        ]);
    }

    public function actions()
    {
        return [];
    }

    public function actionCreate()
    {
        $model = new EventAttendance;
        $model->loadDefaultValues();
        $model->load($this->request->post(), '');
        $model->save();

        return $model;
    }
}