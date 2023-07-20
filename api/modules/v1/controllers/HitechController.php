<?php

namespace api\modules\v1\controllers;

use api\models\FreelancerCategoryList;
use common\models\CareerApply;
use common\models\Freelancer;
use api\models\Hitech;
use common\models\HitechProposal;
use common\models\Job;
use common\models\HitechSearch;
use common\models\MentorsAdviceRequest;
use common\models\OrgUnitSearch;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\models\OauthAccessTokens;
use Yii;
use yii\base\BaseObject;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
use yii\web\ServerErrorHttpException;

/**
 * CareerApply controller
 */
class HitechController extends ActiveController
{
    public $modelClass = 'api\models\Hitech';
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
        // disable the "delete" and "create" actions
        unset($actions['create'], $actions['delete'], $actions['update'], $actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $searchModel = new HitechSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
    }

    public function actionSimilarHitech(){
        return new ActiveDataProvider([
            'query' => Hitech::find()->orderBy('id DESC')->limit(3),
        ]);
    }

    public function actionHitechList(){
        return new ActiveDataProvider([
            'query' => FreelancerCategoryList::find()
        ]);
    }

    public function actionHitechProposalCreate()
    {
        $model = new HitechProposal();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }
}