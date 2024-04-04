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
use yii\web\NotFoundHttpException;

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
                'optional' => ['index','view', 'best-organizer']
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
     * @OA\Get(
     *    path="/event/index",
     *    tags={"Events"},
     *    summary="Get events based on the filter and tags",
     *    description="Returns a list of events based on the provided filter and tags",
     *    operationId="getFilteredEvents",
     *    @OA\Parameter(
     *        name="filter",
     *        in="query",
     *        description="Filter value: 1 for upcoming events, 2 for active events, 3 for past events",
     *        required=false,
     *        @OA\Schema(
     *            type="integer",
     *            enum={1, 2, 3}
     *        )
     *    ),
     *    @OA\Parameter(
     *        name="tag_ids[]",
     *        in="query",
     *        description="An array of tag IDs to filter events by",
     *        required=false,
     *        @OA\Schema(
     *            type="array",
     *            @OA\Items(type="integer")
     *        )
     *    ),
     *    @OA\Parameter(
     *        name="except[]",
     *        in="query",
     *        description="ID of the events you do not want to be displayed",
     *        required=false,
     *        @OA\Schema(
     *                  type="array",
     *            @OA\Items(type="integer")
     *        )
     *    ),
     *    @OA\Parameter(
     *        name="expand",
     *        in="query",
     *        description="Expands: eventTimes, sponsors",
     *        required=false,
     *        @OA\Schema(
     *            type="string"
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="items", type="array",
     *                @OA\Items(
     *                    @OA\Property(property="id", type="integer"),
     *                    @OA\Property(property="title", type="string"),
     *                    @OA\Property(property="titleBrief", type="string"),
     *                    @OA\Property(property="picture", type="string", format="url"),
     *                    @OA\Property(property="organizerInfo", type="object",
     *                        @OA\Property(property="id", type="integer"),
     *                        @OA\Property(property="organizer_name", type="string"),
     *                        @OA\Property(property="organizer_avatar", type="string", format="url"),
     *                        @OA\Property(property="organizer_picture", type="string", format="url"),
     *                        @OA\Property(property="organizer_title_brief", type="string"),
     *                        @OA\Property(property="organizer_instagram", type="string"),
     *                        @OA\Property(property="organizer_telegram", type="string"),
     *                        @OA\Property(property="organizer_linkedin", type="string"),
     *                        @OA\Property(property="updated_at", type="integer"),
     *                        @OA\Property(property="updated_by", type="integer"),
     *                        @OA\Property(property="created_at", type="integer"),
     *                        @OA\Property(property="created_by", type="integer"),
     *                        @OA\Property(property="deleted_at", type="integer")
     *                    ),
     *                    @OA\Property(property="price", type="integer"),
     *                    @OA\Property(property="priceBeforeDiscount", type="integer"),
     *                    @OA\Property(property="evandLink", type="string"),
     *                    @OA\Property(property="description", type="string"),
     *                    @OA\Property(property="headlines", type="string", nullable=true),
     *                    @OA\Property(property="address", type="string"),
     *                    @OA\Property(property="longitude", type="number", format="float"),
     *                    @OA\Property(property="latitude", type="number", format="float"),
     *                    @OA\Property(property="status", type="object",
     *                        @OA\Property(property="code", type="integer"),
     *                        @OA\Property(property="title", type="string")
     *                    ),
     *                    @OA\Property(property="tags", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="id", type="integer"),
     *                            @OA\Property(property="name", type="string")
     *                        )
     *                    ),
     *                    @OA\Property(property="eventTimes", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="id", type="integer"),
     *                            @OA\Property(property="start_time", type="string", format="date-time"),
     *                            @OA\Property(property="end_time", type="string", format="date-time")
     *                        )
     *                    ),
     *                    @OA\Property(property="sponsors", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="id", type="integer"),
     *                            @OA\Property(property="name", type="string"),
     *                            @OA\Property(property="logo", type="string", format="url")
     *                        )
     *                    )
     *                )
     *            )
     *        )
     *    ),
     *    @OA\Response(response=400, description="Bad Request")
     * )
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();

        return $searchModel->search(Yii::$app->request->queryParams, '');
    }

    /**
     * @OA\Get(
     *    path="/event/view",
     *    tags={"Events"},
     *    summary="Get event details",
     *    description="Returns the details of a specific event",
     *    operationId="getEvent",
     *    @OA\Parameter(
     *        name="id",
     *        in="query",
     *        description="ID of the event",
     *        required=true,
     *        @OA\Schema(
     *            type="integer"
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="id", type="integer"),
     *            @OA\Property(property="title", type="string"),
     *            @OA\Property(property="titleBrief", type="string"),
     *            @OA\Property(property="picture", type="string", format="url"),
     *            @OA\Property(property="organizerInfo", type="object",
     *                @OA\Property(property="id", type="integer"),
     *                @OA\Property(property="organizer_name", type="string"),
     *                @OA\Property(property="organizer_avatar", type="string", format="url"),
     *                @OA\Property(property="organizer_picture", type="string", format="url"),
     *                @OA\Property(property="organizer_title_brief", type="string"),
     *                @OA\Property(property="organizer_instagram", type="string"),
     *                @OA\Property(property="organizer_telegram", type="string"),
     *                @OA\Property(property="organizer_linkedin", type="string"),
     *                @OA\Property(property="updated_at", type="integer"),
     *                @OA\Property(property="updated_by", type="integer"),
     *                @OA\Property(property="created_at", type="integer"),
     *                @OA\Property(property="created_by", type="integer"),
     *                @OA\Property(property="deleted_at", type="integer")
     *            ),
     *            @OA\Property(property="price", type="integer"),
     *            @OA\Property(property="priceBeforeDiscount", type="integer"),
     *            @OA\Property(property="evandlink", type="string"),
     *            @OA\Property(property="description", type="string"),
     *            @OA\Property(property="headlines", type="string", nullable=true),
     *            @OA\Property(property="address", type="string"),
     *            @OA\Property(property="longitude", type="number", format="float"),
     *            @OA\Property(property="latitude", type="number", format="float"),
     *            @OA\Property(property="status", type="object",
     *                @OA\Property(property="code", type="integer"),
     *                @OA\Property(property="title", type="string")
     *            ),
     *            @OA\Property(property="tagIds", type="array", @OA\Items(type="integer"), nullable=true)
     *        )
     *    ),
     *    @OA\Response(response=400, description="Bad Request"),
     *    @OA\Response(response=404, description="Event not found")
     * )
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    // need to fix
    public function actionBestOrganizer()
    {
        return new ActiveDataProvider([
            'query' => EventOrganizer::find()->orderBy('id DESC')->limit(3),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Event::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}