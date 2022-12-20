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
                        'view' => ['GET', 'HEAD', 'OPTIONS'],
                        'image' => ['GET', 'HEAD', 'OPTIONS'],
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
     * @OA\Post(
     *   path="/career-apply/create",
     *   tags={"CareerApply"},
     *   summary="new career-apply",
     *   description="add a career-apply and generate capcha",
     *   operationId="/career-apply/create",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="CareerApply[first_name]",
     *                   description="first_name of user",
     *                   type="string",
     *                   example="firoozeh"
     *               ),
     *               @OA\Property(
     *                   property="CareerApply[last_name]",
     *                   description="last_name of user",
     *                   type="string",
     *                   example="daeizadeh"
     *               ),
     *      @OA\Property(
     *                   property="CareerApply[mobile]",
     *                   description="mobile of user it should be 11 number and start with 09",
     *                   type="string",
     *                   example="09390315707"
     *               ),
     *       @OA\Property(
     *                   property="CareerApply[email]",
     *                   description="email of user it should validate email",
     *                   type="string",
     *                   example="firoozehdaei@gmail.com"
     *               ),
     *              @OA\Property(
     *                   property="CareerApply[job_position_id]",
     *                   description="id of jobPosition which user select and send carrer apply for it",
     *                   type="integer",
     *                   example="id='1'"
     *               ),
     *              @OA\Property(
     *                   property="CareerApply[cv_file]",
     *                   description="pdf file of career apply",
     *                   type="file",
     *                   example=""
     *               ),
     *              @OA\Property(
     *                   property="CareerApply[description]",
     *                   description="description about your career-apply",
     *                   type="string",
     *                   example="hi im working"
     *               ),
     *              @OA\Property(
     *                   property="CareerApply[captchaKey]",
     *                   description="a key for understand user",
     *                   type="string",
     *                   example="1670305326.413184"
     *               ),
     *              @OA\Property(
     *                   property="CareerApply[captcha]",
     *                   description="if user isnt sign in he/she should fill the capcha",
     *                   type="string",
     *                   example="wefyhg"
     *               ),
     *           )
     *       )
     *   ),
     *  @OA\Response(
     *         response="200",
     *         description="ok",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="id of carrer-apply"
     *                     ),
     *                     @OA\Property(
     *                         property="first_name",
     *                         type="string",
     *                         description="first_name of user"
     *                     ),
     *                     @OA\Property(
     *                         property="last_name",
     *                         type="string",
     *                         description="last_name of user"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         description="description of user"
     *                     ),
     *                     example={
     *                         "id": "1",
     *                         "first-name":"firoozeh",
     *                         "last_name":"last_name",
     *                         "last_name":"daeizadeh",
     *                         "description":"this is description",
     *
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *   @OA\Response(response="401",description="Unauthorized"),
     * )
     */
    public function actionCreate()
    {
        $model = new CareerApply();
        $model->loadDefaultValues();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->save();
            } else {
                $model->validate();
            }
        }
        return $model;
    }
}