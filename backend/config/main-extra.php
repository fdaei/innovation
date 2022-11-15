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

return $config;