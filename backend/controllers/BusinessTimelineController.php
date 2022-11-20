<?php

namespace backend\controllers;


use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use common\models\BusinessTimelineSearch;
use Exception;
use Yii;
use backend\models\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusinessTimelineController implements the CRUD actions for BusinessTimeline model.
 */
class BusinessTimelineController extends Controller
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
                        'delete' => ['BusinessTimelineST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all BusinessTimeline models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BusinessTimelineSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessTimeline model.
     * @param int $id ID
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
     * Creates a new BusinessTimeline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\ResBusinessTimelinense
     */
    public function actionCreate()
    {
        $model = new BusinessTimeline;
        $TimelineItem = [new BusinessTimelineItem];
        if ($model->load(Yii::$app->request->post())) {
            $TimelineItem = Model::createMultiple(BusinessTimelineItem::className());
            Model::loadMultiple($TimelineItem, Yii::$app->request->post());
            var_dump();
            die();
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($TimelineItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($TimelineItem as $TimelineItem) {
                            $TimelineItem->business_timeline_id = $model->id;
                            if (! ($flag = $TimelineItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'TimelineItem' => (empty($TimelineItem)) ? [new BusinessTimelineItem] : $TimelineItem
        ]);
    }

    /**
     * Updates an existing BusinessTimeline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\ResBusinessTimelinense
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isBusinessTimelinest && $model->load($this->request->BusinessTimelinest()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BusinessTimeline model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return BusinessTimeline|\yii\web\ResBusinessTimelinense
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->canDelete()) {
            $this->findModel($id)->softdelete();
        } else {
            $this->flash('error', array_values($model->errors)[0][0] ?? Yii::t('app', 'Error In Save Info'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the BusinessTimeline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return BusinessTimeline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessTimeline::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
}