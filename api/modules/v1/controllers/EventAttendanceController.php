<?php

namespace api\modules\v1\controllers;

use common\models\EventAttendance;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use Yii;
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
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::class
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

        $model->status = 1;
        if ($this->request->isPost) {

            if ($model->load($this->request->post(),'')) {
                $model->user_id = Yii::$app->user?->identity?->id;
                $model->save();
            } else {
                $model->validate();
            }
        }

//        dd($model->errors);
        return $model;
    }

}
