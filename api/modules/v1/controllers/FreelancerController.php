<?php

namespace api\modules\v1\controllers;

use api\models\FreelancerCategoryList;
use common\models\Freelancer;
use common\models\FreelancerSearch;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;


/**
 * CareerApply controller
 */
class FreelancerController extends ActiveController
{
    public $modelClass = "api\models\Freelancer";
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['rateLimiter']['enableRateLimitHeaders'] = false;
        return $behaviors;

    }

    public function actions()
    {

        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['update'], $actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $searchModel = new FreelancerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $dataProvider;
    }


    public function actionCategoryList(){
        return new ActiveDataProvider([
            'query' => FreelancerCategoryList::find()->where(['model_class'=>Freelancer::className()])
        ]);

    }
}