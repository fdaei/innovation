<?php

namespace api\modules\v1\controllers;

use common\models\EventAttendance;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class EventAttendanceController extends ActiveController
{
    public $modelClass = "common\models\EventAttendance";
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    ['class' => HttpBearerAuth::class],
                    ['class' => QueryParamAuth::class, 'tokenParam' => 'accessToken'],
                ],
                'optional' => ['create']
            ],
        ]);
    }

    public function actions()
    {
        return [];
    }

    /**
     * @OA\Post(
     *   path="/event-attendance/create",
     *   tags={"Event Attendance"},
     *   summary="new event attendance",
     *   description="add event attendance",
     *   operationId="/event-attendance/create",
     *   @OA\Response(response=400, description="Bad request"),
     *   @OA\Response(response=404, description="Resource Not Found"),
     *   @OA\Response(response=422, description="Bad request - Data Validation Failed"),
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="event_id",
     *                   description="id of event",
     *                   type="integer",
     *                   example="3",
     *               ),
     *               @OA\Property(
     *                   property="mobile",
     *                   description="user mobile",
     *                   type="string",
     *                   example="09130001122"
     *               ),
     *                @OA\Property(
     *                   property="first_name",
     *                   description="user first name",
     *                   type="string",
     *                   example="avinox"
     *               ),
     *              @OA\Property(
     *                   property="last_name",
     *                   description="user last name",
     *                   type="string",
     *                   example="avinox"
     *               ),
     *              @OA\Property(
     *                   property="email",
     *                   description="user email",
     *                   type="string",
     *                   example="test@avinox.ir"
     *               ),
     *              @OA\Property(
     *                   property="description",
     *                   description="description of request",
     *                   type="string",
     *                   example="description ..."
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *         response="200",
     *         description="ok",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="id"
     *                     ),
     *                      @OA\Property(
     *                         property="eventId",
     *                         type="integer",
     *                     ),
     *                      @OA\Property(
     *                         property="mobile",
     *                         type="string",
     *                     ),
     *                      @OA\Property(
     *                         property="status",
     *                         example="{'code': 2, 'title': 'تایید شد'}"
     *                     ),
     *                      @OA\Property(
     *                         property="firstName",
     *                         type="string",
     *                     ),
     *                      @OA\Property(
     *                         property="lastName",
     *                         type="string",
     *                     ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                     ),
     *                      @OA\Property(
     *                         property="createdAt",
     *                         type="string",
     *                         example="۱۴۰۲/۰۴/۰۶  ۱۱:۰۱"
     *                     ),
     *                      @OA\Property(
     *                         property="updatedAt",
     *                         type="string",
     *                         example="۱۴۰۲/۰۴/۰۶  ۱۱:۰۱"
     *                     ),
     *                 )
     *             )
     *         }
     *     ),
     *    @OA\Parameter(
     *          name="event_id",
     *          in="query",
     *          required=true,
     *          description="The event ID",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *    ),
     *    @OA\Parameter(
     *          name="mobile",
     *          in="query",
     *          required=true,
     *          description="user mobile",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *    ),
     *    @OA\Parameter(
     *          name="first_name",
     *          in="query",
     *          required=true,
     *          description="user first name",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *    ),
     *    @OA\Parameter(
     *          name="last_name",
     *          in="query",
     *          required=true,
     *          description="user last name",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *    ),
     *    @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=false,
     *          description="user email",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *    ),
     *    @OA\Parameter(
     *          name="discription",
     *          in="query",
     *          required=false,
     *          description="discription",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *    ),
     * )
     */
    public function actionCreate()
    {
        $model = new EventAttendance;
        $model->loadDefaultValues();
        $model->load($this->request->post(), '');
        $model->save();

        return $model;
    }
}