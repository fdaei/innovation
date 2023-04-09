<?php

namespace backend\controllers;

use backend\models\BusinessesServices;
use backend\models\BusinessesSponsors;
use backend\models\BusinessesStatistics;
use common\models\Businesses;
use common\models\BusinessesSearch;
use common\models\BusinessesStory;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BusinessesController implements the CRUD actions for Businesses model.
 */
class BusinessesController extends Controller
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
     * Lists all Businesses models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BusinessesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Businesses model.
     * @param int $id ایدی
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
     * Creates a new Businesses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Businesses();
        $businessesSponsors = [new BusinessesSponsors()];
        $businessesStatistics = [new BusinessesStatistics()];
        $businessesServices = [new BusinessesServices()];
        $businessesStory = [new BusinessesStory()];

        if ($this->request->isPost) {
            $model->status = 1;
            if ($model->load($this->request->post()) && $model->save()) {

                BusinessesStory::handelData($model->id);
                $model->investors   =  BusinessesSponsors::handelData();
                $model->statistics  =  BusinessesStatistics::handelData();
                $model->services    =  BusinessesServices::handelData();

                if($model->save(false)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            print_r($model->errors); die;
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'businessesSponsors' => $businessesSponsors,
            'businessesStatistics' => $businessesStatistics,
            'businessesServices' => $businessesServices,
            'businessesStory' => $businessesStory,
        ]);
    }

    /**
     * Updates an existing Businesses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->investors   =  BusinessesSponsors::handelData();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'eventSponsors' => BusinessesSponsors::loadDefaultValue($model->investors),
        ]);
    }

    /**
     * Deletes an existing Businesses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Businesses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return Businesses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Businesses::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
