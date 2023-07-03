<?php
namespace api\modules\v1;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * Class Module Api
     *
     *
     * @OA\Swagger(
     *     @OA\Server(
     *          url="http://api.ince.local/v1"
     *     ),
     *     @OA\Server(
     *          url="https://api.avapardaz.vc/v1"
     *     ),
     *     @OA\Info(
     *         version="1.0",
     *         title="Innovation Center API",
     *         @OA\Contact(name="Innovation Center", url="https://avapardaz.vc"),
     *     )
     * )
     */
    public function init()
    {
        parent::init();

        Yii::$app->params['currencyMode'] = 2; // Toman
        Yii::$app->params['api-version'] = preg_replace('/[A-za-z]+/', '', $this->id);
    }
}