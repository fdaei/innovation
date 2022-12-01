<?php

namespace api\modules\v1\controllers;

use common\models\CareerApply;
use common\models\OrgUnitSearch;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\HttpException;

/**
 * CareerApply controller
 */
class CareerApplyController extends ActiveController
{
    public $modelClass = "common\models\CareerApply";
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'create' => ['POST', 'OPTIONS'],
                        'units' => ['GET', 'HEAD', 'OPTIONS'],
                    ],
                ],
            ]
        );
    }

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
     *    path = "/career-apply/units",
     *    tags = {"CareerApply"},
     *    operationId = "unit",
     *    summary = "Units List",
     *    description = "List of all Organizations",
     *
     *	@OA\Parameter(
     *        in = "query",
     *        name = "expand",
     *        description = "jobPositions is a expand",
     *        required = false
     *    ),
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */
    public function actionUnits()
    {
        $searchModel = new OrgUnitSearch();
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
     * @OA\Post(path="/career-apply/create",
     *     summary="Add a new career apply",
     *     operationId="careerApplyCreate",
     *     tags={"CareerApply"},
     *
     *	@OA\Parameter(
     *        in = "query",
     *        name = "expand",
     *        description = "",
     *        required = false
     *    ),
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */

    public function actionCreate()
    {
        $model = new CareerApply();
        $model->loadDefaultValues();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->save(false);
            } else {
                $model->validate();
            }
        }

        return $model;
    }
}