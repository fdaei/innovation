<?php

/**@var $logTargetMaskedVars array */

use common\components\Env;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'moresettings' => [
            'class' => 'sadi01\moresettings\SettingsModule',
            'rootAlias' => '@webroot',
            'webAlias' => '@web',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
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

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => true,
                'normalizeTrailingSlash' => true,
            ],
            'rules' => [

            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'hashCallback' => function ($path) {
                return str_replace([Yii::getAlias('@vendor/'), Yii::getAlias('@backend/'), Yii::getAlias('@common/')], '', $path);
            },
            'assetMap' => [
                'yii2-dynamic-form.js' => '@web/js/yii2-dynamic-form.min.js',
                'yii2-dynamic-form.min.js' => '@web/js/yii2-dynamic-form.min.js',
                'froala_editor.min.js' => '@web/js/froala_editor.min.js',
                'leaflet-src.js' => '@web/js/leaflet.js',
                'leaflet.css' => '@web/css/leaflet.css',
            ],
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'basePath' => '@webroot/js',
                    'baseUrl' => '@web/js',
                    'js' => [
                        'bootstrap/popper.min.js',
                        'bootstrap/bootstrap.min.js',
                    ]
                ],
                'yii\bootstrap4\BootstrapAsset' => [
                    'basePath' => '@webroot/css',
                    'baseUrl' => '@web/css',
                    'css' => [
                        'style.min.css',
                    ],
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'basePath' => '@webroot/js',
                    'baseUrl' => '@web/js',
                    'js' => [
                        'jquery.min.js',
                    ]
                ],
            ],

        ],
    ],
    'params' => $params,
];