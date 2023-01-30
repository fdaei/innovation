<?php

$basePath = dirname(__DIR__);
$webroot = dirname($basePath);

return [
    'id' => 'app-common-tests',
    'language' => 'fa-IR',
    'timeZone' => 'Asia/Tehran',
    'name' => 'Mobit Test',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@mainroot' => $webroot,
        '@maindir' => '',
        '@backendRoot' => dirname(dirname(__DIR__)) . '/backend/web',
    ],
    'bootstrap' => [],
    'components' => [
        'session' => [
            'class' => 'yii\redis\Session',
            //'class' => 'yii\web\Session',
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            //'class' => 'yii\caching\FileCache',
        ],
        'Pdate' => [
            'class' => 'common\components\Pdate'
        ],
        'formatter' => [
            'locale' => 'fa_IR@calendar=persian',
            'calendar' => 0,
            'dateFormat' => 'yyyy/MM/dd',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'IRR',
            'numberFormatterSymbols' => [8 => ' '],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    //                    'sourceLanguage' => 'fa-IR',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
                'kvtree' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@vendor/kartik-v/yii2-tree-manager/src/messages',
                    'forceTranslation' => true
                ],
                'kvbase' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'kvbase' => 'app.php',
                    ],
                ],
            ],
        ],
        'Cdn' => [
            'class' => 'common\components\Cdn',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'XhjABGx6oj8u-eDMNP8dU_7BG1LzSjoP',
        ],
        'customHelper' => [
            'class' => 'common\components\CustomHelper'
        ],
    ],

    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ]
];