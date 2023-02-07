<?php

namespace backend\controllers;

use common\models\Branches;
use common\models\BranchesAdmin;
use common\models\BranchesGallery;
use common\models\BranchesSearch;
use common\models\BusinessGallery;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
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
     * Lists all Branches models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();

        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
     * @param int $id ایدی
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'facilities' => $model->branchesSpecifications,
            'gallery'=>$model->branchesGallery
        ]);
    }

    /**
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Branches(['scenario' => Branches::SCENARIO_CREATE]);
        $admin=new BranchesAdmin();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $admin->load($this->request->post()) && $admin->validate()) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->save(false)) {
                        $admin->branche_id=$model->id;
                        $admin->save(false);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'admin'=>$admin
        ]);
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $admin = BranchesAdmin::findOne(['branche_id' => $id]);
        $model->scenario = Branches::SCENARIO_UPDATE;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $admin->load($this->request->post()) && $admin->validate()) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($model->update(false)) {
                        $admin->branche_id=$model->id;
                        $admin->update(false);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'admin'=>$admin
        ]);
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
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
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
}
