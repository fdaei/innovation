<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    protected function verbs()
    {
        return parent::verbs();
    }
    
    public function actionIndex()
    {
        return [];
    }

    public  function actionTest(){
        echo "<pre>";
        var_dump(\Yii::$app->request->params);
        echo "</pre>";
        die();
    }
}