<?php

namespace api\modules\v1\controllers;

use api\models\Event;
use common\models\EventOrganizer;
use common\models\EventSearch;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

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
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    ['class' => HttpBearerAuth::class],
                    ['class' => QueryParamAuth::class, 'tokenParam' => 'accessToken'],
                ],
                'optional' => ['index', 'last-event', 'best-organizer', 'similar-event']
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
        unset($actions['create'], $actions['delete'], $actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;

    }

    public function actionIndex()
    {
        $searchModel = new EventSearch();

        return $searchModel->search(Yii::$app->request->queryParams, '');
    }

    // need to fix
    public function actionBestOrganizer()
    {
        return new ActiveDataProvider([
            'query' => EventOrganizer::find()->orderBy('id DESC')->limit(3),
        ]);
    }

    // need to fix
    public function actionSimilarEvent()
    {
        return new ActiveDataProvider([
            'query' => Event::find()->where(['status' => Event::STATUS_ACTIVE, 'deleted_at' => 0])->orderBy('id DESC')->limit(3),
        ]);
    }
}