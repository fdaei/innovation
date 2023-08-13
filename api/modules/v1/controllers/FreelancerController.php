<?php

namespace api\modules\v1\controllers;

use api\models\FreelancerCategoryList;
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
     *     tags={"Freelancer"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="saeed"),
     *             @OA\Property(property="mobile", type="string", example="09136638049"),
     *             @OA\Property(property="email", type="string", example="test@gmail.com"),
     *             @OA\Property(property="city", type="integer", example="1"),
     *             @OA\Property(property="province", type="integer", example="1"),
     *             @OA\Property(property="marital_status", type="integer", example="1"),
     *             @OA\Property(property="military_service_status", type="integer", example="1"),
     *             @OA\Property(property="activity_field", type="string", example="backend"),
     *             @OA\Property(property="experience", type="integer", example="1"),
     *             @OA\Property(property="experience_period", type="integer", example="1"),
     *             @OA\Property(property="description_user", type="string", example="description..."),
     *             @OA\Property(property="sex", type="integer", example="1"),
     *             @OA\Property(property="project_number", type="integer", example="36"),
     *             @OA\Property(property="skills", type="array",
     *                 @OA\Items(@OA\Property(property="title", type="string"),)
     *              ),
     *             @OA\Property(property="record_job", type="array",
     *                 @OA\Items(@OA\Property(property="title", type="string"),)
     *              ),
     *             @OA\Property(property="record_educational", type="array",
     *                 @OA\Items(@OA\Property(property="title", type="string"),)
     *              ),
     *             @OA\Property(property="portfolio", type="array",
     *                 @OA\Items(
     *                    @OA\Property(property="title", type="string"),
     *                    @OA\Property(property="description", type="string"),
     *                    @OA\Property(property="link", type="string"),
     *                    @OA\Property(property="image", type="file"),
     *                  )
     *              ),
     *        )
     *     ),
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

    public function actionIndex()
    {
        $searchModel = new FreelancerSearch();
        $searchModel->status = Freelancer::STATUS_ACTIVE;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
    }

    public function actionCategoryList()
    {
        return new ActiveDataProvider([
            'query' => FreelancerCategoryList::find()
        ]);
    }
}