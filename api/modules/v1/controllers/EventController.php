<?php

namespace api\modules\v1\controllers;

use common\models\CareerApply;
use common\models\EventOrganizer;
use common\models\MentorsAdviceRequest;
use common\models\OrgUnitSearch;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\models\OauthAccessTokens;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
use api\models\Event;
/**
 * CareerApply controller
 */
class EventController extends ActiveController
{
    public $modelClass = "api\models\Event";
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

    public function actionLastEvent(){
        return new ActiveDataProvider([
            'query' => Event::find()->orderBy('id DESC')->limit(3),
        ]);
    }

    // need to fix
    public function actionBestOrganizer(){
        return new ActiveDataProvider([
            'query' => EventOrganizer::find()->orderBy('id DESC')->limit(3),
        ]);
    }

    // need to fix
    public function actionSimilarEvent(){
        return new ActiveDataProvider([
            'query' => Event::find()->orderBy('id DESC')->limit(3),
        ]);
    }
}