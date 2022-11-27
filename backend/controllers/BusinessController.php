<?php

namespace backend\controllers;


use common\models\Business;
use common\models\BusinessSearch;
use common\models\BusinessTimeline;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusinessController implements the CRUD actions for Business model.
 */
class BusinessController extends Controller
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
     * Lists all Business models.
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
     * Displays a single Business model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'gallery' => $model->businessGalleries,
            'members' => $model->businessMembers,
            'timeline' => $model->getBusinessTimelines()->orderBy([BusinessTimeline::tableName() . '.year' => SORT_ASC])->all(),
            'timelineitems' => $model->businessTimeLineItems,
            'stat' => $model->businessStates,
        ]);
    }

    /**
     * Creates a new Business model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Business(['scenario' => Business::SCENARIO_CREATE]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save(false)) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Business model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Business::SCENARIO_UPDATE;
        $transaction = \Yii::$app->db->beginTransaction();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                try {
                    if ($model->save(false)) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Business model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->canDelete()) {
            $this->findModel($id)->softdelete();
            return $this->redirect(['index']);
        } else {
            $this->addError('قادر به حذف نیستیم ');
        }

    }

    /**
     * Finds the Business model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Business the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Business::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
