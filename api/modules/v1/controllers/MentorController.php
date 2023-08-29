<?php

namespace api\modules\v1\controllers;

use common\models\CareerApply;
use common\models\MentorCategory;
use common\models\MentorsAdviceRequest;
use common\models\MentorSearch;
use common\models\OrgUnitSearch;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\models\OauthAccessTokens;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\data\ActiveDataProvider;
use api\models\FreelancerCategoryList;
use common\models\Mentor;

/**
 * CareerApply controller
 */
class MentorController extends ActiveController
{
    public $modelClass = 'api\models\Mentor';
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
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::class
            ],
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['create']['modelClass'] = 'api\models\MentorCreate';
        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['update'], $actions['index']);
        return $actions;
    }

    /**
     * Get events based on the filter and tags.
     *
     * Returns a list of events based on the provided filter and tags.
     *
     * @return array
     * @OA\Get(
     *    path="/mentor",
     *    tags={"Mentors"},
     *    summary="Get mentors based on the filter and categories",
     *    description="Returns a list of mentors based on the provided filter and categories",
     *    operationId="getFilteredMentors",
     *    @OA\Parameter(
     *        name="categories",
     *        in="query",
     *        description="An array of category IDs to filter mentors by",
     *        required=false,
     *        @OA\Schema(
     *            type="array",
     *            @OA\Items(type="integer")
     *        )
     *    ),
     *    @OA\Parameter(
     *        name="expand",
     *        in="query",
     *        description="Expands: Category",
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
     *                    @OA\Property(property="name", type="string"),
     *                    @OA\Property(property="picture", type="string", format="url"),
     *                    @OA\Property(property="activity_field", type="string"),
     *                    @OA\Property(property="activity_description", type="string"),
     *                    @OA\Property(property="instagram", type="string"),
     *                    @OA\Property(property="linkedin", type="string"),
     *                    @OA\Property(property="twitter", type="string"),
     *                    @OA\Property(property="telegram", type="string"),
     *                    @OA\Property(property="Category", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="id", type="integer"),
     *                            @OA\Property(property="title", type="string"),
     *                            @OA\Property(property="brief_description", type="string"),
     *                            @OA\Property(property="picture", type="string", format="url"),
     *                            @OA\Property(property="status", type="integer"),
     *                            @OA\Property(property="updated_by", type="integer"),
     *                            @OA\Property(property="updated_at", type="integer"),
     *                            @OA\Property(property="created_at", type="integer"),
     *                            @OA\Property(property="deleted_at", type="integer"),
     *                            @OA\Property(property="created_by", type="integer")
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
        $searchModel = new MentorSearch();
        return $searchModel->search(Yii::$app->request->queryParams, '');
    }


    /**
     * Create a new advice request for mentors.
     *
     * Creates a new advice request for mentors based on the provided data.
     *
     * @return MentorsAdviceRequest|array
     * @throws ServerErrorHttpException if the object creation fails for any reason.
     * @OA\Post(
     *    path="/mentor/advice-request",
     *    tags={"Mentors"},
     *    summary="Create a new advice request for mentors",
     *    description="Creates a new advice request for mentors based on the provided data",
     *    operationId="createMentorsAdviceRequest",
     *    @OA\RequestBody(
     *        required=true,
     *        description="Advice request data",
     *    ),
     *    @OA\Response(
     *        response=201,
     *        description="Success",
     *    ),
     *    @OA\Response(response=400, description="Bad Request"),
     *    @OA\Response(response=500, description="Server Error")
     * )
     */
    public function actionAdviceRequest()
    {
        $model = new MentorsAdviceRequest([
            'user_id' => Yii::$app->user->identity->id
        ]);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            return $model;
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for an unknown reason.');
        }

        return $model;
    }


    /**
     * Get a list of mentor categories.
     *
     * Returns a list of mentor categories.
     *
     * @return ActiveDataProvider
     * @OA\Get(
     *    path="/mentor/category-list",
     *    tags={"Mentors"},
     *    summary="Get a list of mentor categories",
     *    description="Returns a list of mentor categories",
     *    operationId="getMentorCategories",
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="items", type="array",
     *                @OA\Items(
     *                    @OA\Property(property="id", type="integer"),
     *                    @OA\Property(property="title", type="string"),
     *                    @OA\Property(property="brief_description", type="string"),
     *                    @OA\Property(property="picture", type="string", format="url"),
     *                    @OA\Property(property="status", type="integer"),
     *                    @OA\Property(property="updated_by", type="integer"),
     *                    @OA\Property(property="updated_at", type="integer"),
     *                    @OA\Property(property="created_at", type="integer"),
     *                    @OA\Property(property="deleted_at", type="integer"),
     *                    @OA\Property(property="created_by", type="integer")
     *                )
     *            )
     *        )
     *    ),
     *    @OA\Response(response=400, description="Bad Request")
     * )
     * @throws NotFoundHttpException
     */
    public function actionCategoryList()
    {
        return new ActiveDataProvider([
            'query' => MentorCategory::find()
        ]);
    }
}