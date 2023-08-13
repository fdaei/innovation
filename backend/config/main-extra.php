<?php
/**@var $logTargetMaskedVars array */
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

if (!YII_ENV_PROD) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*.*', '10.61.195.143'] // adjust this to your needs
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.146.93','*'],
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'lel' => '@app/gii-generators/crud', // template name => path to template
                ]
            ],
            'model' => [ // generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'lel' => '@app/gii-generators/model/default', // template name => path to template
                ]
            ]

        ],
    ];
}

if (!YII_DEBUG) {
    $config['components']['log']['targets'][] = [
        'class' => 'notamedia\sentry\SentryTarget',
        'dsn' => 'https://1d71a842350f442588b1eee331a82a71@sentry.avapardaz.org/17',
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