<?php

namespace api\modules\v1\controllers;


use common\models\JobPosition;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * CareerApply controller
 */
class JobPositionController extends ActiveController
{
    public $modelClass = "common\models\JobPosition";
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
                        'view' => ['GET', 'HEAD', 'OPTIONS'],
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
     *    path = "/job-position/id",
     *    tags = {"JobPosition"},
     *    operationId = "job-position View",
     *    summary = "view of job-position",
     *    description = "GET /job-position/123: return the details of the job-position 123",
     *
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }
    private function findModel($id)
    {
        if (($model = JobPosition::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}