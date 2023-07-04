<?php

namespace backend\controllers;

use api\models\FreelancerCategoryList;
use common\models\FreelancerCategories;
use common\models\FreelancerPortfolio;
use backend\models\FreelancerRecordEducational;
use backend\models\FreelancerRecordJob;
use backend\models\FreelancerSkills;
use common\models\Freelancer;
use common\models\FreelancerSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * FreelancerController implements the CRUD actions for Freelancer model.
 */
class FreelancerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Freelancer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FreelancerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Freelancer model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Freelancer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Freelancer();
        $freelancerSkills = [new FreelancerSkills()];
        $freelancerRecordJob = [new FreelancerRecordJob()];
        $freelancerRecordEducational = [new FreelancerRecordEducational()];
        $freelancerPortfolio = [new FreelancerPortfolio()];

        if ($this->request->isPost) {

            $model->skills = FreelancerSkills::Handler($this->request->post('FreelancerSkills'));
            $model->record_job = FreelancerRecordJob::Handler($this->request->post('FreelancerRecordJob'));
            $model->record_educational = FreelancerRecordEducational::Handler($this->request->post('FreelancerRecordEducational'));
            $freelancerPortfolio = FreelancerPortfolio::Handler($this->request->post('FreelancerPortfolio'));
//            $freelancerCat = FreelancerCategories::Handler($this->request->post('Freelancer')['categories_list']);

            $model->load($this->request->post());

            if ($save = $model->save()) {
                foreach ($freelancerPortfolio as $portfolio) {
                    $portfolio->freelancer_id = $model->id;
                    $portfolio->save();
                }

                $model->categories_list = $this->request->post('Freelancer')['categories_list'];
                foreach ($model->categories_list as $cat) {
                    $categories = new FreelancerCategories();
                    $categories->categories_id = $cat;
                    $categories->freelancer_id = $model->id;
                    $categories->model_class = $model::class;
                    $categories->save();
                }



            }

            if ($save) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'freelancerSkills' => (empty($freelancerSkills)) ? [new FreelancerSkills()] : $freelancerSkills,
            'freelancerRecordJob' => (empty($freelancerRecordJob)) ? [new FreelancerRecordJob()] : $freelancerRecordJob,
            'freelancerRecordEducational' => (empty($freelancerRecordEducational)) ? [new FreelancerRecordEducational()] : $freelancerRecordEducational,
            'freelancerPortfolio' => (empty($freelancerPortfolio)) ? [new FreelancerPortfolio()] : $freelancerPortfolio,

        ]);
    }


    /**
     * Updates an existing Freelancer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $portfolios = FreelancerPortfolio::find()->where(['freelancer_id' => $model->id])->all();

        $categoriesChecked = FreelancerCategoryList::find()
            ->innerJoin('{{%freelancer_categories}}', '{{%freelancer_categories}}.`categories_id` = {{%freelancer_category_list}}.`id`')
            ->where(['{{%freelancer_categories}}.freelancer_id' => $model->id])
            ->asArray()
            ->all();
        $model->categories_list = ArrayHelper::map($categoriesChecked, 'id','id');

        if ($this->request->isPost) {

            $model->skills = FreelancerSkills::Handler($this->request->post('FreelancerSkills'));
            $model->record_job = FreelancerRecordJob::Handler($this->request->post('FreelancerRecordJob'));
            $model->record_educational = FreelancerRecordEducational::Handler($this->request->post('FreelancerRecordEducational'));
            $portfolios = FreelancerPortfolio::Handler($portfolios);
            if ($model->load($this->request->post()) && $model->save()) {
//              -- insert new portfolio
                foreach ($portfolios as $index => $portfolio) {
                    $portfolio->freelancer_id = $model->id;
                    $portfolio->instanceNames = [
                        'image' => "FreelancerPortfolio[{$index}][image]"
                    ];
                    $portfolio->save();
                }
//              -- End insert new portfolio
//              -- remove and insert categories
                $newCkeck = $model->categories_list = $this->request->post('Freelancer')['categories_list'];
                // convert to int
                $newCkeck = $newCkeck ? array_map('intval', $newCkeck) : [];
                $checkedIds = [];
                foreach ($categoriesChecked as $item){ $checkedIds[] = $item['id'];}
                // diff
                $remove = array_diff($checkedIds,$newCkeck);
                $new = array_diff($newCkeck,$checkedIds);
                FreelancerCategories::deleteAll(['categories_id' => $remove , 'freelancer_id' => $model->id]);
                foreach ($new as $item){
                    $categories = new FreelancerCategories();
                    $categories->categories_id = $item;
                    $categories->freelancer_id = $model->id;
                    $categories->model_class = $model::class;
                    $categories->save();
                }
//              -- End  remove and insert categories

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'freelancerSkills' => FreelancerSkills::loadDefaultValue($model->skills),
            'freelancerRecordJob' => FreelancerRecordJob::loadDefaultValue($model->record_job),
            'freelancerRecordEducational' => FreelancerRecordEducational::loadDefaultValue($model->record_educational),
            'freelancerPortfolio' => (empty($portfolios)) ? [new FreelancerPortfolio()] : $portfolios
        ]);
    }

    /**
     * Deletes an existing Freelancer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Freelancer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Freelancer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Freelancer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
