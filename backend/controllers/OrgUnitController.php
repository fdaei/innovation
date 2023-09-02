<?php

namespace backend\controllers;

use common\models\OrgUnit;
use common\models\OrgUnitSearch;
use common\traits\AjaxValidationTrait;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrgUnitController implements the CRUD actions for OrgUnit model.
 */
class OrgUnitController extends Controller
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
     * Lists all OrgUnit models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrgUnitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrgUnit model.
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
     * Creates a new OrgUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new OrgUnit();
        $model->loadDefaultValues();
        if ($model->load($this->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            } else {
                return $this->asJson([
                    'success' => false,
                    'msg' => Yii::t("app", 'Error creating new organization')
                ]);
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrgUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load($this->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            } else {
                return $this->asJson([
                    'success' => false,
                    'msg' => Yii::t("app", 'Error updating organization')
                ]);
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrgUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->canDelete() && $model->softDelete()) {
            return $this->asJson([
                'status' => true,
                'message' => Yii::t("app", 'Item Deleted')
            ]);
        } else {
            return $this->asJson([
                'status' => false,
                'message' => Yii::t("app", 'Error In Delete Action')
            ]);
        }
    }


    /**
     * Finds the OrgUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return OrgUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrgUnit::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
}
