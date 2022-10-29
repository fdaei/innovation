<?php
namespace api\modules\v1;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\v1\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->params['currencyMode'] = 2; // Toman
        Yii::$app->params['api-version'] = preg_replace('/[A-za-z]+/', '', $this->id);
    }
}
