<?php

namespace backend\controllers;

use backend\models\EventHeadlines;
use common\models\Event;
use common\models\EventSearch;
use common\models\EventTime;
use common\models\Model;
use common\models\Tag;
use common\models\TagAssign;
use common\traits\AjaxValidationTrait;
use common\traits\CoreTrait;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{
    use AjaxValidationTrait, CoreTrait;

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

    public function actionAddTags($id)
    {
        $model = Event::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('The requested event does not exist.');
        }

        if (Yii::$app->request->isPost) {
            $tagIds = Yii::$app->request->post('Event')['tagIds'] ?? [];
            $model->tagIds = $tagIds;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Tags added successfully.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to add tags.');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('add_tags', [
            'model' => $model,
        ]);
    }


    /**
     * Lists all Event models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Event;
        $model->scenario = Event::SCENARIO_CREATE;
        $modelsEventTime = [new EventTime];
        $searchedTags = Tag::find()->andWhere(['in', 'tag_id', $model->tagNames])->all();
        if ($model->load(Yii::$app->request->post())) {
            $modelsEventTime = Model::createMultiple(EventTime::class);
            Model::loadMultiple($modelsEventTime, Yii::$app->request->post());
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsEventTime) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $tagNames = Yii::$app->request->post('Event')['tagNames'];
                    if (!empty($tagNames)) {
                        $tagIds = [];
                        foreach ($tagNames as $tagName) {
                            $existingTag = Tag::findOne(['tag_id' => $tagName]);
                            if ($existingTag) {
                                $tagIds[] = $existingTag->tag_id;
                            } else {
                                $newTag = new Tag(['name' => $tagName, 'type' => '1']);
                                $newTag->validate();
                                $newTag->save(false);
                                $tagIds[] = $newTag->tag_id;
                            }
                        }
                        $model->tagNames = $tagIds;
                    }
                    if ($flag = $model->save(false)) {
                        foreach ($modelsEventTime as $event) {
                            $event->event_id = $model->id;
                            if (!($flag = $event->save(false))) {
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
                    throw $e;
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'EventTimes' => (empty($EventTimes)) ? [new EventTime] : $modelsEventTime,
            'searchedTags' => $searchedTags,
        ]);
    }


    public function actionCreateHeadlines($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Event::SCENARIO_UPDATE;
        $form = new ActiveForm();
        $MentorRecords = [new EventHeadlines()];
        if ($this->request->isPost) {
            $newData = EventHeadlines::headLineHandler($model->headlines);
            $newModels = [];

            foreach ($newData as $item) {
                $newModel = new EventHeadlines();
                $newModel->attributes = $item;
                $newModels[] = $newModel;
            }

            // Validate all models
            $isValid = EventHeadlines::validateMultiple($newModels);

            if ($isValid) {
                if ($model->headlines) {
                    $model->headlines = array_merge($model->headlines, $newData);
                } else {
                    $model->headlines = $newData;
                }
                if ($model->save()) {
                    return $this->asJson([
                        'success' => true,
                        'msg' => Yii::t("app", 'Success')
                    ]);
                }
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_headlines', [
            'model' => $model,
            'eventHeadlines' => $MentorRecords,
            'form' => $form,
        ]);
    }

    public function actionUpdateHeadlines($id)
    {
        $model = $this->findModel($id);
        $form = new ActiveForm();

        if ($this->request->isPost) {
            $model->headlines = EventHeadlines::headLineHandler($model->headlines);
            foreach ($model->headlines as $item) {
                $newModel = new EventHeadlines();
                $newModel->attributes = $item;
                $newModels[] = $newModel;
            }
            // Validate all models
            $isValid = EventHeadlines::validateMultiple($newModels);
            if ($model->save()) {
                return $this->asJson([
                    'success' => true,
                    'msg' => Yii::t("app", 'Success')
                ]);
            }
        }
        $this->performAjaxValidation($model);
        return $this->renderAjax('_headlines', [
            'model' => $model,
            'eventHeadlines' => EventHeadlines::loadDefaultValue($model->headlines),
            'form' => $form,
        ]);

    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ایدی
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchedTags = Tag::find()->andWhere(['in', 'tag_id', $model->tagNames])->asArray()->all();

        $modelsEventTime = $model->eventTimes;
        if ($model->load(Yii::$app->request->post())) {
            $tagNames = Yii::$app->request->post('Event')['tagNames'];
            if (!empty($tagNames)) {
                $tagIds = [];
                foreach ($tagNames as $tagName) {
                    $existingTag = Tag::findOne(['tag_id' => $tagName]);
                    if ($existingTag) {
                        $tagIds[] = $existingTag->tag_id;
                    } else {
                        $newTag = new Tag(['name' => $tagName, 'type' => '1']);
                        $newTag->validate();
                        $newTag->save(false);
                        $tagIds[] = $newTag->tag_id;
                    }
                }
                $model->tagNames = $tagIds;
            }
            $oldIDs = ArrayHelper::map($modelsEventTime, 'id', 'id');
            $modelsEventTime = Model::createMultiple(EventTime::class, $modelsEventTime);
            Model::loadMultiple($modelsEventTime, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEventTime, 'id', 'id')));
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsEventTime) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            EventTime::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsEventTime as $event) {
                            $event->event_id = $model->id;
                            if (!($flag = $event->save(false))) {
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
                    throw $e;
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'EventTimes' => (empty($modelsEventTime)) ? [new EventTime] : $modelsEventTime,
            'searchedTags' => $searchedTags,
        ]);
    }


    public function actionUpdateTime($id)
    {

        $model = $this->findModel($id);
        $modelsEventTime = $model->eventTimes;
        if (Yii::$app->request->post()) {
            $oldIDs = ArrayHelper::map($modelsEventTime, 'id', 'id');
            $modelsEventTime = Model::createMultiple(EventTime::class, $modelsEventTime);
            Model::loadMultiple($modelsEventTime, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEventTime, 'id', 'id')));
            $valid = Model::validateMultiple($modelsEventTime);
            if ($valid) {
                try {
                    $flag = true;
                    if (!empty($deletedIDs)) {
                        EventTime::deleteAll(['id' => $deletedIDs]);
                    }
                    foreach ($modelsEventTime as $event) {
                        $event->event_id = $model->id;
                        $flag = $event->save(false) && $flag;
                    }
                    if ($flag) {
                        return $this->asJson([
                            'success' => true,
                            'msg' => Yii::t("app", 'Success')
                        ]);
                    }
                } catch (Exception $e) {
                    return $this->asJson([
                        'success' => false,
                        'msg' => Yii::t("app", 'fail to update')
                    ]);

                }
            }
        }
        return $this->renderAjax('_time', [
            'EventTimes' => (empty($modelsEventTime)) ? [new EventTime] : $modelsEventTime,
        ]);
    }


    /**
     * Deletes an existing Event model.
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

    public function flash($type, $message)
    {
        Yii::$app->getSession()->setFlash($type == 'error' ? 'danger' : $type, $message);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ایدی
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}