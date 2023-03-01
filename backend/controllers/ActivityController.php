<?php

namespace backend\controllers;

use common\models\Activity;
use common\models\ActivityComment;
use common\models\ActivityCommentSearch;
use common\models\ActivitySearch;
use common\models\ActivityUserAssignment;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class ActivityController extends Controller
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
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ایدی
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $comment = new ActivityComment();
        $searchModel = new ActivityCommentSearch();
        $model = $this->findModel($id);
        $comments=$model->activityComments;
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($this->request->isPost) {
            if ($comment->load($this->request->post()) && $comment->validate()) {
                $comment->activity_id=$id;
                $comment->save();
                return $this->redirect(['view', 'id' =>$id]);
            }
        } else {
            $comment->loadDefaultValues();
        }
        return $this->render('view', [
            'model' =>$model,
            'comment' => $comment,
            'comments'=>$comments,
        ]);
    }
    public function actionCreate()
    {
        $model = new Activity();
        $assignment= new ActivityUserAssignment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate() && $assignment->load($this->request->post()) && $assignment->validate()) {
                $transaction = \Yii::$app->db->beginTransaction();
                if($model->save()){
                    $assignment->activity_id=$model->id;
                    $assignment->save();
                    $transaction->commit();
                    return $this->redirect(['index']);
                }else{
                    $transaction->rollBack();
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
            'assignment'=>$assignment
        ]);
    }
    /**
     * Deletes an existing Task model.
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

    public function actionChange()
    {
        $data=Yii::$app->request->post();
        $i=(int)$data['id'];
        $model = Activity::findOne(['id' => 16]);
        return $model;
//        $model->status=1;
//        return $model->save();
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }

}
