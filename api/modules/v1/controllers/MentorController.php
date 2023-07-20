<?php

namespace api\modules\v1\controllers;

use common\models\CareerApply;
use common\models\MentorsAdviceRequest;
use common\models\MentorSearch;
use common\models\OrgUnitSearch;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\models\OauthAccessTokens;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
use yii\data\ActiveDataProvider;
use api\models\FreelancerCategoryList;
use common\models\Mentor;

/**
 * CareerApply controller
 */
class MentorController extends ActiveController
{
    public $modelClass = 'api\models\Mentor';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
//            'authenticator' => [
//                'class' => CompositeAuth::class,
//                'authMethods' => [
//                    ['class' => HttpBearerAuth::class],
//                    ['class' => QueryParamAuth::class, 'tokenParam' => 'accessToken'],
//                ]
//            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::class
            ],
        ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['create']['modelClass'] = 'api\models\MentorCreate';
        // disable the "delete" and "create" actions
        unset( $actions['delete'], $actions['update'], $actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $searchModel = new MentorSearch();
        $searchModel->status = Mentor::STATUS_ACTIVE;
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $dataProvider;
    }

    public function actionAdviceRequest(){
        $model = new \api\models\MentorsAdviceRequest;

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

    public function actionCategoryList(){
        return new ActiveDataProvider([
            'query' => FreelancerCategoryList::find()
        ]);
    }
}