<?php
/**@var $logTargetMaskedVars array */
use common\components\Env;

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => Env::get('API_COOKIE_VALIDATION_KEY'),
            'trustedHosts' => ['0.0.0.0/0'],
            'ipHeaders' => ['X-Real-Ip']
        ],
    ],
];

if (!YII_DEBUG) {
    $config['components']['log']['targets'][] = [
        'class' => 'notamedia\sentry\SentryTarget',
        'dsn' => 'https://be51b2b0ad6f45d380aa5ac865c85b7b@sentry.avapardaz.org/16',
        'levels' => ['error', 'warning'],
        'logVars' => [
            '_GET',
            '_POST',
            '_FILES',
            '_COOKIE',
            '_SESSION',
            '_SERVER',
        ],
        'maskVars' => $logTargetMaskedVars,
        'except' => [
            'yii\web\HttpException:401',
            'yii\web\HttpException:403',
            'yii\web\HttpException:410',
        ],
        // Write the context information (the default is true)
        'context' => true,
//        'extraCallback' => function ($message, $extra) {
//            // some manipulation with data
//            $extra['some_data'] = \Yii::$app->someComponent->someMethod();
//            return $extra;
//        },
        // Additional options for `Sentry\init`:
        //'clientOptions' => ['release' => 'my-project-name@2.3.12']
    ];
}

return $config;