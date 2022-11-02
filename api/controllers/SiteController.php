<?php

namespace api\controllers;

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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error',
                'view' => 'error'
            ]
        ];
    }

    public function actionIndex()
    {
        return [];
    }
}