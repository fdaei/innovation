<?php

namespace api\modules\v1\controllers;

use common\models\CareerApply;
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

/**
 * CareerApply controller
 */
class MentorsAdviceRequestsController extends ActiveController
{
    public $modelClass = "common\models\MentorsAdviceRequest";
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
        // disable the "delete" and "create" actions
        unset($actions['index'], $actions['create'], $actions['delete'], $actions['view'], $actions['update']);
        return $actions;
    }

    /**
     * @OA\Post(
     *   path="/mentors-advice-requests/create",
     *   tags={"Mentor"},
     *   summary="new mentors-advice-requests",
     *   description="add a mentors-advice-requests ",
     *   operationId="/mentors-advice-requests/create",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="MentorsAdviceRequest[mentor_id]",
     *                   description="id of mentor",
     *                   type="integer",
     *                   example="1"
     *               ),
     *               @OA\Property(
     *                   property="MentorsAdviceRequest[description]",
     *                   description="description of request",
     *                   type="string",
     *                   example="i need it ...."
     *               ),
     *                @OA\Property(
     *                   property="MentorsAdviceRequest[date_advice]",
     *                   description="time of meeting",
     *                   type="string",
     *                   example="1401/12/10"
     *               ),
     *              @OA\Property(
     *                   property="MentorsAdviceRequest[type]",
     *                   description="face to face or online meeting",
     *                   type="integer",
     *                   example="1"
     *               ),
     *              @OA\Property(
     *                   property="MentorsAdviceRequest[status]",
     *                   description="status i dont khonw",
     *                   type="integer",
     *                   example="1"
     *               ),
     *              @OA\Property(
     *                   property="MentorsAdviceRequest[file]",
     *                   description="file of meeting",
     *                   type="file",
     *                  format="binary"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response=400, description="Bad request"),
     *   @OA\Response(response=404, description="Resource Not Found"),
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
     *                         description="id of mentors-advice-requests"
     *                     ),
     *                   @OA\Property(
     *                         property="user_id",
     *                         type="integer",
     *                         description="id of user"
     *                     ),
     *                     @OA\Property(
     *                         property="mentor_id",
     *                         type="integer",
     *                         description="id of mentor"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         description="description of request"
     *                     ),
     *                     @OA\Property(
     *                         property="date_advice",
     *                         type="string",
     *                         description="time of meeting"
     *                     ),
     *                  @OA\Property(
     *                         property="type",
     *                         type="integer",
     *                         description="face to face or online"
     *                     ),
     *                 @OA\Property(
     *                         property="file",
     *                         type="file",
     *                         description="file of meeting "
     *                     ),
     *                 @OA\Property(
     *                         property="status",
     *                         type="integer",
     *                         description="status of meeting"
     *                     ),
     *
     *                 )
     *             )
     *         }
     *     ),
     * )
     */
    public function actionCreate()
    {
        $model = new MentorsAdviceRequest([
            'user_id' => Yii::$app->user->identity->id
        ]);
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