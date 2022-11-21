<?php
use common\components\Env;
use common\components\swagger\SwaggerApi;

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => Env::get('BACKEND_COOKIE_VALIDATION_KEY'),
                        'trustedHosts' => ['0.0.0.0/0'],
            'ipHeaders' => ['X-Real-Ip']
        ]
    ],
    'modules' => [
        'swagger' => [
            'class' => SwaggerApi::class,
            //  'url' => 'http://petstore.swagger.io/v2/swagger.json',
            'path' => '@api/modules/v1',
            // disable page with your logic
            'isDisable' => function () {
                return false;
            },
            // replace placeholders in swagger content
            'afterRender' => function ($content) {
                return $content;
            }
        ]
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'generators' => [
//            'mongoDbModel' => [
//                'class' => 'yii\mongodb\gii\model\Generator'
//            ]
        ],
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '172.18.0.1'],
    ];
}

if (!YII_DEBUG) {
    $config['components']['log']['targets'][] = [
        'class' => 'notamedia\sentry\SentryTarget',
        'dsn' => 'https://1d71a842350f442588b1eee331a82a71@sentry.avapardaz.org/17',
        'levels' => ['error', 'warning'],
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