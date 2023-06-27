<?php

namespace backend\controllers;

use common\models\Tag;
use common\models\TagSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all Tag models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch();


        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param int $id
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
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tag();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->validate()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionList($query, $type = null)
    {
        $out = [
            'results' => [
                'id' => '',
                'text' => '',
                'html' => '',
                'color' => '',
                'type' => '',
            ]
        ];
        if (!is_null($query)) {
            $search_keys = explode(' ', $query);
            $like_condition = [];
            $like_condition[0] = 'AND';
            if (count($search_keys) > 1) {
                foreach ($search_keys as $key) {
                    $like_condition[] = ['like', "name", $key];
                }
            } else {
                $like_condition[] = ['like', "name", $query];
            }

            if ($type) {
                $like_condition[] = [Tag::tableName() . '.type' => $type];
            }

            $data = Tag::find()
                ->andWhere($like_condition)
                ->limit(10)
                ->all();

            $arr = [];
            $i = -1;
            foreach ($data as $d) {
                $i++;
                $arr[$i]['id'] = $d->tag_id;
                $arr[$i]['color'] = $d->color;
                $arr[$i]['type'] = $d->type;

                $arr[$i]['text'] = !$d->color ?
                    '<span class="mx-1 font-medium text-white badge badge-' . Tag::itemAlias('TypeClass', $d->type) . '" title="' . Tag::itemAlias('Type', $d->type) . '">' . $d->name . '</span>'
                    :
                    '<span class="mx-1 font-medium text-white" style="background-color:#' . $d->color . ';padding: .20em .5em;border-radius: 2px;font-size: 90%;" title="' . Tag::itemAlias('Type', $d->type) . '">' . $d->name . '</span>';
                $arr[$i]['html'] = $arr[$i]['text'];
            }
            $out['results'] = $arr;
        }

        return $this->asJson($out);
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
