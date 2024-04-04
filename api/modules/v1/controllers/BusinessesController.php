<?php

namespace api\modules\v1\controllers;

use api\models\Businesses;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * CareerApply controller
 */
class BusinessesController extends ActiveController
{
    public $modelClass = 'api\models\Businesses';
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

    /**
     * @param $slug
     * @return Businesses
     * @throws NotFoundHttpException
     */
    public function actionSlug($slug)
    {
        return $this->findModelBySlug($slug);
    }

    public function actions()
    {
        $actions = parent::actions();
        // disable the "delete" and "create" actions
        unset($actions['create'], $actions['delete'], $actions['update']);
        return $actions;
    }

    /**
     * Finds the Businesses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Businesses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelBySlug($slug)
    {
        if (($model = Businesses::find()->bySlug($slug)->limit(1)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}