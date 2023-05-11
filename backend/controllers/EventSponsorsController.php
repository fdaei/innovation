<?php

namespace backend\controllers;

use common\models\EventSponsors;
use common\models\EventSponsorsSearch;
use common\traits\AjaxValidationTrait;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventSponsorsController implements the CRUD actions for EventSponsors model.
 */
class EventSponsorsController extends Controller
{
    use AjaxValidationTrait;
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
     * Lists all EventSponsors models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventSponsorsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EventSponsors model.
     * @param int $id ایدی
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EventSponsors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new EventSponsors();
        $model->event_id=$id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EventSponsors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->asJson([
                'success' => true,
                'msg' => Yii::t("app", 'Success')
            ]);
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EventSponsors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$model_id)
    {
        if ($this->findModel($id)->delete()) {
            return $this->asJson([
                'status' => true,
                'message' => Yii::t("app", "Item Deleted")
            ]);
        } else {
            return $this->asJson([
                'status' => false,
                'message' => Yii::t("app", "Error In delete Info")
            ]);
        }
    }

    /**
     * Finds the EventSponsors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return EventSponsors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventSponsors::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
