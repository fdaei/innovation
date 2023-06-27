<?php

namespace api\modules\v1\controllers;

use common\models\Event;
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
use yii\web\HttpException;

/**
 * CareerApply controller
 */
class EventController extends ActiveController
{
    public $modelClass = "common\models\Event";
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
                'optional' => ['index', 'best-organizer', 'similar-event']
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
    /**
     * @OA\Info(
     *   version="1.0.0",
     *   title="Event API",
     *   @OA\License(name="MIT"),
     *   @OA\Attachable()
     * )
     */

    /**
     * @OA\Get(
     *    path="/event/index",
     *    tags={"Events"},
     *    summary="Get events based on the filter",
     *    description="Returns a list of events based on the filter value",
     *    operationId="getEvents",
     *    @OA\Parameter(
     *        name="filter",
     *        in="query",
     *        description="Filter value: 1 for upcoming events, 2 for active events, 3 for past events",
     *        required=true,
     *        @OA\Schema(
     *            type="integer",
     *            enum={1, 2, 3}
     *        )
     *    ),
     *    @OA\Parameter(
     *        name="expand",
     *        in="query",
     *        description="Expands: sponsors, eventTimes",
     *        required=false,
     *        @OA\Schema(
     *            type="string"
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *    ),
     *    @OA\Response(response=400, description="Bad Request")
     * )
     * @throws HttpException
     */
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