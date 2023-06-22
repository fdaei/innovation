<?php

namespace api\modules\v1\controllers;

use common\models\EventOrganizer;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use api\models\Event;

/**
 * CareerApply controller
 */
class EventController extends ActiveController
{
    public $modelClass = "api\models\Event";
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
        unset($actions['create'], $actions['delete'], $actions['update']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $provider = new \yii\data\ActiveDataProvider([
            'query' => Event::find()->where(['status'=>Event::STATUS_ACTIVE,'deleted_at'=>0])
        ]);

        return $provider;
    }

    public function actionLastEvent($status){

        var_dump('aaaaaa');
        die();

        if($status==1){
            return new ActiveDataProvider([
                'query' => Event::find()
                    ->where(['status'=>Event::STATUS_ACTIVE,'deleted_at'=>0])
                    ->orderBy('id DESC'),
            ]);
        }elseif ($status==2){
            $time = new \DateTime('UTC');
            $start_at = clone $time;
            $end_at = clone $time;
            $start_at->sub(new \DateInterval('PT' . 30 . 'M'));
            $end_at->add(new \DateInterval('PT' . 30 . 'M'));

            $dataProvider =  new ActiveDataProvider([
                'query' => Event::find()
                    ->where(['status'=>Event::STATUS_ACTIVE,'deleted_at'=>0])
                    ->joinWith('{{%event-time}}')
                    ->andWhere(['>','{{%event-time}}.start_at',$start_at->getTimestamp()])
                    ->andWhere(['<','{{%event-time}}.end_at',$end_at->getTimestamp()])
                    ->orderBy('id DESC')
                    ->limit(3),
            ]);

            return $dataProvider;
        }elseif ($status==3){
            return new ActiveDataProvider([
                'query' => Event::find()->where(['status'=>Event::STATUS_HELD,'deleted_at'=>0])->orderBy('id DESC'),
            ]);
        }
    }

    // need to fix
    public function actionBestOrganizer(){
        return new ActiveDataProvider([
            'query' => EventOrganizer::find()->orderBy('id DESC')->limit(3),
        ]);
    }

    // need to fix
    public function actionSimilarEvent(){
        return new ActiveDataProvider([
            'query' => Event::find()->where(['status'=>Event::STATUS_ACTIVE,'deleted_at'=>0])->orderBy('id DESC')->limit(3),
        ]);
    }
}