<?php

namespace api\modules\v1\controllers;

use common\components\CaptchaHelper;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\HttpException;

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
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'index' => ['GET', 'HEAD', 'OPTIONS'],
                        'captcha' => ['GET', 'HEAD', 'OPTIONS'],
                    ],
                ],
            ]
        );
    }

    protected function verbs()
    {
        return parent::verbs();
    }

    public function actionIndex()
    {
        return [];
    }

    /**
     * @OA\Info(
     *   version="1.0.0",
     *   title="My API",
     *   @OA\License(name="MIT"),
     *   @OA\Attachable()
     * )
     */
    /**
     * @OA\Get(
     *    path = "/site/captcha",
     *    tags = {"Site"},
     *    operationId = "captcha",
     *    summary = "Captcha",
     *    description = "Send image of capcha",
     *	@OA\Response(response = 200, description = "success")
     *)
     * @throws HttpException
     */
    public function actionCaptcha()
    {
        return (new CaptchaHelper())->generateImage();
    }
}