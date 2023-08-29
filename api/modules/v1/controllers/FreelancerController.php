<?php

namespace api\modules\v1\controllers;

use api\models\FreelancerCategoryList;
use common\models\Event;
use common\models\Freelancer;
use common\models\FreelancerPortfolio;
use common\models\FreelancerSearch;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;
use yii\data\ActiveDataProvider;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * FreelancerController
 */
class FreelancerController extends ActiveController
{
    public $modelClass = 'api\models\Freelancer';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $action = Yii::$app->controller->action->id;

        if ($action === 'create') {
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    ['class' => HttpBearerAuth::class],
                    ['class' => QueryParamAuth::class, 'tokenParam' => 'accessToken']
                ],
            ];
        }
        $behaviors['exceptionFilter'] = [
            'class' => ErrorToExceptionFilter::class,
        ];

        return $behaviors;
    }

    public function actions()
    {
        return [];
    }

    /**
     * @OA\Post(
     *     path="/freelancer/create",
     *     summary="freelancer create",
     *     tags={"Freelancers"},
     *     security={{ "bearerAuth": {} }},
     *   @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={
     *                      "name",
     *                      "mobile",
     *                      "email",
     *                      "city",
     *                      "province",
     *                      "marital_status",
     *                      "military_service_status",
     *                      "activity_field",
     *                      "experience",
     *                      "experience_period",
     *                      "description_user",
     *                      "sex",
     *                      "project_number",
     *                      "accept_rules",
     *                      "skills"
     *                  },
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="mobile", type="string"),
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="city", type="integer"),
     *                  @OA\Property(property="province", type="integer"),
     *                  @OA\Property(property="marital_status", type="integer"),
     *                  @OA\Property(property="military_service_status", type="integer"),
     *                  @OA\Property(property="activity_field", type="string"),
     *                  @OA\Property(property="experience", type="integer"),
     *                  @OA\Property(property="experience_period", type="integer"),
     *                  @OA\Property(property="description_user", type="string"),
     *                  @OA\Property(property="sex", type="integer"),
     *                  @OA\Property(property="project_number", type="integer"),
     *                  @OA\Property(property="accept_rules", type="boolean"),
     *                  @OA\Property(property="skills", type="array",
     *                      @OA\Items(@OA\Property(property="title", type="string"))
     *                  ),
     *                  @OA\Property(property="record_job", type="array",
     *                      @OA\Items(@OA\Property(property="title", type="string"))
     *                  ),
     *                  @OA\Property(property="record_educational", type="array",
     *                      @OA\Items(@OA\Property(property="title", type="string"))
     *                  ),
     *                  @OA\Property(property="portfolio", type="array",
     *                      @OA\Items(
     *                         @OA\Property(property="title", type="string"),
     *                         @OA\Property(property="description", type="string"),
     *                         @OA\Property(property="link", type="string"),
     *                         @OA\Property(property="image", type="string")
     *                      )
     *                  )
     *              )
     *          )
     *      ),
     *    @OA\Parameter(name="name",in="path",required=true),
     *    @OA\Parameter(name="mobile",in="query",required=true),
     *    @OA\Parameter(name="email",in="query",required=true),
     *    @OA\Parameter(name="header_picture_mobile",in="query",@OA\Schema(type="file")),
     *    @OA\Parameter(name="header_picture_desktop",in="query",@OA\Schema(type="file")),
     *    @OA\Parameter(name="freelancer_picture",in="query",@OA\Schema(type="file")),
     *    @OA\Parameter(name="resume_file",in="query",@OA\Schema(type="file")),
     *    @OA\Parameter(name="sex",in="query",required=true,@OA\Schema(type="integer",enum={1, 2})),
     *    @OA\Parameter(name="city",in="query",required=true,@OA\Schema(type="integer",enum={1, 2})),
     *    @OA\Parameter(name="province",in="query",required=true,@OA\Schema(type="integer",enum={1, 2})),
     *    @OA\Parameter(name="marital_status",in="query",required=true,@OA\Schema(type="integer",enum={1, 2})),
     *    @OA\Parameter(name="military_service_status",in="query",required=true,@OA\Schema(type="integer",enum={1, 2})),
     *    @OA\Parameter(name="activity_field",in="query",required=true),
     *    @OA\Parameter(name="experience",in="query",required=true),
     *    @OA\Parameter(name="experience_period",in="query",required=true),
     *    @OA\Parameter(name="description_user",in="query",required=true),
     *    @OA\Parameter(name="project_number",in="query",required=true),
     *    @OA\Parameter(name="skills[]",in="query",description="skills",required=false,
     *        @OA\Schema(type="array",@OA\Items(type="string"))
     *    ),
     *    @OA\Parameter(name="record_job[]",in="query",description="record job",required=false,
     *        @OA\Schema(type="array",@OA\Items(type="string"))
     *    ),
     *    @OA\Parameter(name="record_educational[]",in="query",description="record educational",required=false,
     *        @OA\Schema(type="array",@OA\Items(type="string"))
     *    ),
     *    @OA\Parameter(name="portfolio[]",in="query",description="portfolio",required=false,
     *        @OA\Schema(type="array",
     *          @OA\Items(
     *              @OA\Property(property="title", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="link", type="string"),
     *              @OA\Property(property="image", type="file"),
     *          ),
     *        )
     *    ),
     *
     *    @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function actionCreate()
    {
        $model = new Freelancer();
        $model->loadDefaultValues();
        $model->scenario = $model::SCENARIO_API;

        if ($this->request->isPost) {
            if ($model->load($this->request->post(), '')) {

                $model->resume_file = UploadedFile::getInstanceByName('resume_file');
                $model->header_picture_mobile = UploadedFile::getInstanceByName('header_picture_mobile');
                $model->header_picture_desktop = UploadedFile::getInstanceByName('header_picture_desktop');
                $model->freelancer_picture = UploadedFile::getInstanceByName('freelancer_picture');
                $model->user_id = Yii::$app->user->id;
                $model->save();

                $freelancerPortfolio = FreelancerPortfolio::Handler($this->request->post('FreelancerPortfolio'));
                foreach ($freelancerPortfolio as $index => $portfolio) {
                    $portfolio->freelancer_id = $model->id;
                    $portfolio->instanceNames = [
                        'image' => "FreelancerPortfolio[{$index}][image]"
                    ];
                    $portfolio->save();
                }

            } else {
                $model->validate();
            }
        }
        return $model;
    }

    /**
     * View details of a mentor by ID.
     *
     * Returns details of a mentor based on the provided ID.
     *
     * @param integer $id The ID of the mentor.
     * @return Mentor|array
     * @throws NotFoundHttpException if the mentor cannot be found.
     * @OA\Get(
     *    path="/mentor/{id}",
     *    tags={"Mentors"},
     *    summary="View details of a mentor by ID",
     *    description="Returns details of a mentor based on the provided ID",
     *    operationId="viewMentor",
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="The ID of the mentor",
     *        required=true,
     *        @OA\Schema(
     *            type="integer"
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *    ),
     *    @OA\Response(response=404, description="Not Found")
     * )
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }


    /**
     * Get a list of active freelancers.
     *
     * Returns a list of active freelancers based on the provided filter criteria.
     *
     * @return ActiveDataProvider
     * @OA\Get(
     *    path="/freelancer",
     *    tags={"Freelancers"},
     *    summary="Get a list of active freelancers",
     *    description="Returns a list of active freelancers based on the provided filter criteria",
     *    operationId="getActiveFreelancers",
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
     *    @OA\Response(
     *        response=200,
     *        description="Success",
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(property="items", type="array",
     *                @OA\Items(
     *                    @OA\Property(property="id", type="integer"),
     *                    @OA\Property(property="name", type="string"),
     *                    @OA\Property(property="mobile", type="string"),
     *                    @OA\Property(property="email", type="string"),
     *                    @OA\Property(property="city", type="integer"),
     *                    @OA\Property(property="province", type="integer"),
     *                    @OA\Property(property="marital_status", type="integer"),
     *                    @OA\Property(property="military_service_status", type="integer"),
     *                    @OA\Property(property="activity_field", type="string"),
     *                    @OA\Property(property="experience", type="integer"),
     *                    @OA\Property(property="experience_period", type="integer"),
     *                    @OA\Property(property="description_user", type="string"),
     *                    @OA\Property(property="sex", type="integer"),
     *                    @OA\Property(property="project_number", type="integer"),
     *                    @OA\Property(property="accept_rules", type="boolean"),
     *                    @OA\Property(property="skills", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="title", type="string")
     *                        )
     *                    ),
     *                    @OA\Property(property="record_job", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="title", type="string")
     *                        )
     *                    ),
     *                    @OA\Property(property="record_educational", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="title", type="string")
     *                        )
     *                    ),
     *                    @OA\Property(property="portfolio", type="array",
     *                        @OA\Items(
     *                            @OA\Property(property="title", type="string"),
     *                            @OA\Property(property="description", type="string"),
     *                            @OA\Property(property="link", type="string")
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
        $searchModel = new FreelancerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, '');

        return $dataProvider;
    }


    /**
     * Get a list of freelancer categories.
     *
     * Returns a list of freelancer categories.
     *
     * @return ActiveDataProvider
     * @OA\Get(
     *    path="/freelancer/category-list",
     *    tags={"Freelancers"},
     *    summary="Get a list of freelancer categories",
     *    description="Returns a list of freelancer categories",
     *    operationId="getFreelancerCategories",
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
     *                    @OA\Property(property="picture", type="string"),
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
     */
    public function actionCategoryList()
    {
        return new ActiveDataProvider([
            'query' => FreelancerCategoryList::find()
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Freelancer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}