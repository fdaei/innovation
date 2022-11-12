<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\rest\Controller;
use common\models\Business;
use common\models\BusinessSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * BusinessController implements the CRUD actions for Business model.
 */
class BusinessController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public $modelClass='common\models\Business';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => \yii\filters\VerbFilter::class,
                    'actions' => [
                        'index'  => ['GET'],
                        'view'   => ['GET'],
                        'create' => ['GET', 'POST'],
                        'update' => ['GET', 'PUT', 'POST'],
                        'delete' => ['POST', 'DELETE'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new BusinessSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
    }

    /**
     * Displays a single Business model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * Creates a new Business model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Business();
        if($model->load(yii::$app->request->post()) && $model->validate())
        {
            $model->save();
            return array('status' => true, 'data'=> 'bussiness record is successfully updated');
        } else {
            return array('status'=>false,'data'=>$model->getErrors());
        }
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

        if($model->load(yii::$app->request->post()) && $model->validate())
        {
            $model->save();
            return array('status' => true, 'data'=> 'bussiness record is successfully updated');
        } else {
            return array('status'=>false,'data'=>$model->getErrors());
        }
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
            return array('status' => true, 'data'=> 'bussiness record is successfully deleted');
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
