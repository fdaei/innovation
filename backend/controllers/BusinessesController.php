<?php

namespace backend\controllers;

use backend\models\BusinessesServices;
use backend\models\BusinessesSponsors;
use backend\models\BusinessesStatistics;
use common\models\Businesses;
use common\models\BusinessesStory;
use common\models\BusinessSearch;
use Yii;
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
        return $this->render('view', [
            'model' => $model,
            'story' => $model->businessesStory,
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
                $model->statistics = array_merge($model->statistics, $newData);

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
