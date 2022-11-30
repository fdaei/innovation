<?php

namespace api\modules\v1\controllers;


use common\models\BusinessSearch;
use common\models\CareerApply;
use common\models\JobPosition;
use common\models\JobPositionSearch;
use common\models\OrgUnit;
use common\models\OrgUnitSearch;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\HttpException;

/**
 * Site controller
 */
class PositionController extends Controller
{
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
                        'create' => ['POST'],
                        'view' => ['GET'],
                    ],
                ],
            ]
        );
    }

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['view'], $actions['update']);
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
     *    path = "/jobposition",
     *    tags = {"jobposition"},
     *    operationId = "jobposition",
     *    summary = "jobposition List",
     *    description = "List of all jobposition",
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
    public function actionIndex()
    {
        $searchModel = new OrgUnitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
    }

    public function actionCreate()
    {
        $model = new CareerApply();

        if ($this->request->isPost) {
            if ($model->load($this->request->post(),'') && $model->validate()) {
                $model->save(false);
            } else {
                $model->validate();
            }
            return $model;
        } else {
            $model->loadDefaultValues();
        }
        return $model;
    }

}