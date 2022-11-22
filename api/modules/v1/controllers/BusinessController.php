<?php

namespace api\modules\v1\controllers;

use common\models\Business;
use common\models\BusinessSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * BusinessController implements the CRUD actions for Business model.
 */
class BusinessController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];


    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'index' => ['GET'],
                        'view' => ['GET'],
                    ],
                ],
            ]
        );
    }

    // TODO unset Create, Update, Delete actions

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create'], $actions['update']);
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
     *    path = "/business",
     *    tags = {"Business"},
     *    operationId = "Business",
     *    summary = "Business List",
     *    description = "List of all business",
     *
     *	@OA\Parameter(
     *        in = "query",
     *        name = "expand",
     *        description = "timeLines,galleries,satat,members are expand of bussiness / items is expand of timeLines",
     *        required = false
     *    ),
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */
    public function actionIndex()
    {
        $searchModel = new BusinessSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
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
     *    path = "/business/id",
     *    tags = {"BusinessView"},
     *    operationId = "Business",
     *    summary = "view of business",
     *    description = "GET /business/123: return the details of the business 123",
     *
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */
    /**
     * Displays a single Business model.
     * @param int $id ID
     * @return Business
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    public function actionSlug($slug)
    {
        return $this->findModelBySlug($slug);
    }

    /**
     * Finds the Business model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Business the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Business::find()->bySlug($slug)->limit(1)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function findModel($id)
    {
        if (($model = Business::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}