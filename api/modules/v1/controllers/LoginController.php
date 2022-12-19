<?php

namespace api\modules\v1\controllers;
use filsh\yii2\oauth2server\models\OauthClients;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\rest\ActiveController;
use yii\rest\Controller;

/**
 * Site controller
 */
class LoginController extends ActiveController
{
    public $modelClass = "common\models\User";
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [

                    ],
                ],
            ]
        );
    }
    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['index'], $actions['create'], $actions['delete'], $actions['view'], $actions['update']);
        return $actions;
    }
    public function actionPassword($username,$password,$client_id){
        $model = OauthClients::find()->where(['client_id'=>$client_id])->one();
//        $response=['Type'=>'password','value'=>$password];
//        $response.json_encode();
        $data=[
            'client_id'=>$client_id,
            'username'=>$username,
            'password'=>$password,
            'client_secret'=>$model['client_secret'],
            'grant_type'=>'password',
        ];
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('http://api.ince.local/oauth2/rest/token')
            ->setData($data)
            ->send();
    }
    public function actionNumber($number,$VerifyCode,$client_id){
        $model = OauthClients::find()->where(['client_id'=>$client_id])->one();
        $response=['Type'=>'number','value'=>$number];
        $response.json_encode();
        return[
            'client_id'=>$client_id,
            'username'=>$number,
            'password'=>$response,
            'client_secret'=>$model['client_secret'],
            'grant_type'=>'password',
        ];
    }
}