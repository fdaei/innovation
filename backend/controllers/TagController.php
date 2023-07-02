<?php

namespace backend\controllers;

use common\models\Tag;
use common\models\TagSearch;
use common\traits\AjaxValidationTrait;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TagController extends Controller
{
    use AjaxValidationTrait;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' =>
                    [
                        [
                            'allow' => true,
                            'actions' => ['create', 'index', 'update', 'delete', 'list'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['list'],
                            'roles' => ['@'],
                        ],
                    ]
            ]
        ];
    }

    /**
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Tag model via ajax.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tag();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $flag = $model->save(false);
                if ($flag) {
                    $transaction->commit();
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return [
                        'status' => 'success',
                        'tag' => ['id' => $model->tag_id, 'name' => $model->name],
                        'success' => true,
                        'msg' => Yii::t("app", "Tag created!")
                    ];
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        $this->performAjaxValidation($model);

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $flag = $model->save(false);

                if ($flag) {
                    $transaction->commit();
                    Yii::$app->response->format = Response::FORMAT_JSON;

                    return [
                        'success' => true,
                        'msg' => Yii::t("app", "Tag updated!")
                    ];
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }

        $this->performAjaxValidation($model);

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $result = ['status' => true];

        if ($model->softDelete()) {
            $result = [
                'status' => true,
                'message' => Yii::t("app", "Item Deleted")
            ];
        } else {
            $result = [
                'status' => false,
                'message' => Yii::t("app", "Error In Save Info")
            ];
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionList($query, $type = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [
            'results' => [
                'id'   => '',
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
        return $out;
    }

    /**
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}