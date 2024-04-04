<?php

namespace backend\controllers;

use backend\models\BusinessesServices;
use backend\models\BusinessStoryText;
use common\models\BusinessesStory;
use common\models\BusinessesStorySearch;
use common\traits\AjaxValidationTrait;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BusinessesStoryController implements the CRUD actions for BusinessesStory model.
 */
class BusinessesStoryController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all BusinessesStory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BusinessesStorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessesStory model.
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
     * Creates a new BusinessesStory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = new BusinessesStory();
        $businessesText = [new BusinessStoryText()];
        $model->businesses_id=$id;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->texts=BusinessStoryText::handelData();
                $model->save();
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
            'businessesText' =>$businessesText,
        ]);
    }

    /**
     * Updates an existing BusinessesStory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$model_id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->texts=BusinessStoryText::handelData();
            $model->save();
            return $this->asJson([
                'success' => true,
                'msg' => Yii::t("app", 'Success')
            ]);
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('update', [
            'model' => $model,
            'businessesText' => BusinessStoryText::loadDefaultValue($model->texts),
        ]);
    }

    /**
     * Deletes an existing BusinessesStory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$model_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Url::to(['businesses/view', 'id' => $model_id]));
    }

    /**
     * Finds the BusinessesStory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return BusinessesStory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessesStory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
