<?php
/**@var $logTargetMaskedVars array */
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [

    ],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'common\fixtures',
        ],
        'migration' => [
            'class' => 'bizley\migration\controllers\MigrationController',
            'skipMigrations' => [
                'm140501_075311_add_oauth2_server'
            ],
            //'fixHistory' => true
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [

            ],
            'migrationPath' => [
                '@vendor/yiisoft/yii2/log/migrations',
                '@app/migrations'
            ]
        ],
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
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
                ],
                [
                    'class' => \yii\log\DbTarget::class,
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
                ],
            ],

        ],
    ],
    'params' => $params,
];