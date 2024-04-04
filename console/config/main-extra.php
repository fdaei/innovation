<?php
/**@var $logTargetMaskedVars array */
$config = [

];

if (!YII_DEBUG) {
    $config['components']['log']['targets'][] = [
        'class' => 'notamedia\sentry\SentryTarget',
        'dsn' => 'https://fd04548af8694c55867d6c07a55179ea@sentry.avapardaz.org/18',
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