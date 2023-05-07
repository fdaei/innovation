<?php

namespace backend\controllers;

use backend\models\BusinessesServices;
use backend\models\BusinessesSponsors;
use backend\models\BusinessesStatistics;
use common\models\Businesses;
use common\models\BusinessesStory;
use common\models\BusinessSearch;
use common\models\BusinessTimeline;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

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
                    'class' => VerbFilter::className(),
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
        $searchModel = new BusinessSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Businesses model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $investors=$model->businessesInvestors;
        return $this->render('view', [
            'model' => $model,
            'story' => $model->businessesStory,
            'gallery' => $model->businessGalleries,
            'members' => $model->businessMembers,
            'timeline' => $model->getBusinessTimelines()->orderBy([BusinessTimeline::tableName() . '.year' => SORT_ASC])->all(),
            'timelineitems' => $model->businessTimeLineItems,
            'stat' => $model->businessStates,
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

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = 1;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Businesses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionCreateStatistics($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();
        $businessesStatistics = [new BusinessesStatistics()];

        if ($this->request->isPost) {
            $newData = BusinessesStatistics::handelData();
            $newModels = [];

            foreach ($newData as $item) {
                $newModel = new BusinessesStatistics();
                $newModel->attributes = $item;
                $newModel->scenario = BusinessesStatistics::SCENARIO_CREATE;
                $newModels[] = $newModel;
            }

            // Validate all models
            $isValid = BusinessesStatistics::validateMultiple($newModels);

            if ($isValid) {
                if($model->statistics){
                    $model->statistics = array_merge($model->statistics, $newData);
                }else {
                    $model->statistics = $newData;
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->renderAjax('_statistics', [
            'model' => $model,
            'businessesStatistics' => $businessesStatistics,
            'form' => $form,
        ]);
    }
    public function actionUpdateStatistics($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();

        if ($this->request->isPost) {
            $model->statistics  =  BusinessesStatistics::handelData();
            foreach ( $model->statistics  as $item) {
                $newModel = new BusinessesStatistics();
                $newModel->attributes = $item;
                $newModel->scenario = BusinessesStatistics::SCENARIO_CREATE;
                $newModels[] = $newModel;
            }
            // Validate all models
            $isValid = BusinessesStatistics::validateMultiple($newModels);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->renderAjax('_statistics', [
            'model' => $model,
            'businessesStatistics' => BusinessesStatistics::loadDefaultValue($model->statistics),
            'form' => $form,
        ]);

    }
    public function actionCreateServices($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();
        $BusinessesServices = [new BusinessesServices()];

        if ($this->request->isPost) {
            $newData = BusinessesServices::handelData();
            $newModels = [];

            foreach ($newData as $item) {
                $newModel = new BusinessesServices();
                $newModel->attributes = $item;
                $newModels[] = $newModel;
            }

            // Validate all models
            $isValid = BusinessesServices::validateMultiple($newModels);

            if ($isValid) {
                if($model->services){
                    $model->services = array_merge($model->services, $newData);
                }else {
                    $model->services = $newData;
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->renderAjax('_services', [
            'model' => $model,
            'BusinessesServices' => $BusinessesServices,
            'form' => $form,
        ]);
    }
    public function actionUpdateServices($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();

        if ($this->request->isPost) {
            $model->services  =  BusinessesServices::handelData();
            foreach ( $model->services  as $item) {
                $newModel = new BusinessesServices();
                $newModel->attributes = $item;

                $newModels[] = $newModel;
            }
            // Validate all models
            $isValid = BusinessesServices::validateMultiple($newModels);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->renderAjax('_services', [
            'model' => $model,
            'BusinessesServices' => BusinessesServices::loadDefaultValue($model->services),
            'form' => $form,
        ]);

    }
    public function actionPicCreate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && $model->save(false) ) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->renderAjax('_picture', [
            'model' => $model,
        ]);
    }

    public function actionPicUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->validate() && $model->save(false) ) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        return $this->renderAjax('_picture', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Businesses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->canDelete() && $model->softDelete()) {
            $this->flash('success', Yii::t('app', 'Item Deleted'));
        } else {
            $this->flash('error', $model->errors ? array_values($model->errors)[0][0] : Yii::t('app', 'Error In Delete Action'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Businesses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Businesses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Businesses::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
}
