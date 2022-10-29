<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

    }

    protected function verbs()
    {
        return parent::verbs();
    }
    
    public function actionIndex()
    {
        return [];
    }
}
