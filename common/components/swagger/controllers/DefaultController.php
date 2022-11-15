<?php

namespace common\components\swagger\controllers;

use yii\filters\AccessControl;

class DefaultController extends \sadi01\swagger\controllers\DefaultController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [
                            '@'
                        ],
                    ],
                ]
            ]
        ];
    }
}