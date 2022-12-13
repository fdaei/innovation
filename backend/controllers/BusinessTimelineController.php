<?php

namespace backend\controllers;

use aminbbb92\user\traits\AjaxValidationTrait;
use common\models\BaseModel;
use common\models\BusinessTimeline;
use common\models\BusinessTimelineItem;
use common\models\BusinessTimelineSearch;
use Exception;
use yii\web\Response;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BusinessTimelineController implements the CRUD actions for BusinessTimeline model.
 */
class BusinessTimelineController extends Controller
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
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new BusinessTimeline;
        $TimelineItems = [new BusinessTimelineItem];
        if ($model->load(Yii::$app->request->post())) {
            $TimelineItems = BaseModel::createMultiple(BusinessTimelineItem::class);
            BaseModel::loadMultiple($TimelineItems, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = BaseModel::validateMultiple($TimelineItems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (($flag = $model->save())) {
                        foreach ($TimelineItems as $TimelineItem) {
                            /** @var $TimelineItem BusinessTimelineItem*/
                            $TimelineItem->business_timeline_id = $model->id;
                            if (!($flag = $TimelineItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->asJson([
                            'success' => true,
                            'msg' => Yii::t("app", 'Success')
                        ]);
                    }else{
                        return $this->asJson([
                            'success' => false,
                            'msg' => Yii::t("app", 'Erorr in Save ')
                        ]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('create', [
            'model' => $model,
            'TimelineItem' => (empty($TimelineItems)) ? [new BusinessTimelineItem] : $TimelineItems
        ]);
    }

    /**
     * Updates an existing BusinessTimeline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelItems = $model->timeLineIem;
        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelItems, 'id', 'id');
            $modelItems = BaseModel::createMultiple(BusinessTimelineItem::class, multipleModels:$modelItems);
            BaseModel::loadMultiple($modelItems, Yii::$app->request->post());

            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelItems, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = BaseModel::validateMultiple($modelItems) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            BusinessTimelineItem::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelItems as $item) {
                            $item->business_timeline_id = $model->id;
                            if (! ($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['/business/view', 'id' => $model->business['id']]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    return $e;
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'TimelineItem' => (empty($modelItems)) ? [new BusinessTimelineItem] : $modelItems
        ]);
    }

    /**
     * Deletes an existing BusinessTimeline model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->canDelete() && $model->softDelete()) {
            $this->flash('success', Yii::t('app', 'Item Deleted'));
        } else {
            $this->flash('error', array_values($model->errors)[0][0] ?? Yii::t('app', 'Error In Delete Info'));
        }

        return $this->redirect(['/business/view', 'id' => $model->business['id']]);
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