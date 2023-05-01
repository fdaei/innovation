<?php

namespace backend\controllers;

use backend\models\EventHeadlines;
use backend\models\MentorRecords;
use common\models\MentorServices;
use common\models\Mentor;
use common\models\MentorSearch;
use common\models\Model;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MentorController implements the CRUD actions for Mentor model.
 */
class MentorController extends Controller
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
     * Lists all Mentor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MentorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mentor model.
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
     * Creates a new Mentor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Mentor();
        $mentorRecords = [new MentorRecords()];
        $mentorServices = [new MentorServices()];

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {

                $model->records  = MentorRecords::handelData();
                if($model->save()){
                    MentorServices::handelData($model->id);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
            print_r($model->errors); die;
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'mentorServices' => $mentorServices,
            'mentorRecords'  => $mentorRecords
        ]);
    }

    /**
     * Updates an existing Mentor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {

            $model->records  = MentorRecords::handelData();
            MentorServices::handelData($model->id,$model->mentorServices);
            $model->save();


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'mentorRecords'  => MentorRecords::loadDefaultValue($model->records),
            'mentorServices' => !empty($model->mentorServices) ? $model->mentorServices :  [new MentorServices()],
        ]);
    }

    /**
     * Deletes an existing Mentor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ایدی
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->canDelete() && $model->deleted()) {
            $this->flash('success', Yii::t('app', 'Item Deleted'));
        } else {
            $this->flash('error', $model->errors ? array_values($model->errors)[0][0] : Yii::t('app', 'Error In Delete Action'));
        }

        return $this->redirect(['index']);
    }
    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }
    /**
     * Finds the Mentor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return Mentor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mentor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
