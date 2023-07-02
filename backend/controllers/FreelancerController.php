<?php

namespace backend\controllers;

use common\models\FreelancerPortfolio;
use backend\models\FreelancerRecordEducational;
use backend\models\FreelancerRecordJob;
use backend\models\FreelancerSkills;
use common\models\Freelancer;
use common\models\FreelancerSearch;
use yii\filters\AccessControl;
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

            $model->load($this->request->post());

            if ($save = $model->save(false)) {
                foreach ($freelancerPortfolio as $portfolio) {
                    $portfolio->freelancer_id = $model->id;
                    $portfolio->save(false);
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

        if ($this->request->isPost) {

            $model->skills = FreelancerSkills::Handler($this->request->post('FreelancerSkills'));
            $model->record_job = FreelancerRecordJob::Handler($this->request->post('FreelancerRecordJob'));
            $model->record_educational = FreelancerRecordEducational::Handler($this->request->post('FreelancerRecordEducational'));
            $portfolios = FreelancerPortfolio::Handler($portfolios);

            if ($model->load($this->request->post()) && $model->save()) {
                foreach ($portfolios as $portfolio) {
                    $portfolio->freelancer_id = $model->id;
                    $portfolio->save(false);
                }
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
