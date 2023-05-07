<?php

namespace api\modules\v1\controllers;

use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

/**
 * CareerApply controller
 */
class BusinessesController extends ActiveController
{
    public $modelClass = 'api\models\Businesses';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
//            'authenticator' => [
//                'class' => CompositeAuth::class,
//                'authMethods' => [
//                    ['class' => HttpBearerAuth::class],
//                    ['class' => QueryParamAuth::class, 'tokenParam' => 'accessToken'],
//                ]
//            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::class
            ],
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['create'], $actions['delete'], $actions['update']);
        return $actions;
    }
}