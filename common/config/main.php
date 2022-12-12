<?php

use common\components\Env;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@inceRoot' => Env::get('INCE_ROOT'),
        '@inceWeb' => Env::get('INCE_WEB'),
        '@cdnRoot' => Env::get('CDN_ROOT'),
        '@cdnWeb' => Env::get('CDN_WEB')
    ],
    'language' => 'fa-IR',
    'timeZone' => 'Asia/Tehran',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    // 'sourceLanguage' => 'fa-IR',
                    'fileMap' => [
                        'app' => 'app.php'
                    ],
                ],
            ],
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            //'class' => 'yii\web\Session',
        ],
        'formatter' => [
            'locale' => 'fa_IR@c\alendar=persian',
            'calendar' => 0,
            'dateFormat' => 'yyyy/MM/dd',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'IRR',
            'numberFormatterSymbols' => [8 => ' '],
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
            //'class' => 'yii\caching\FileCache',
        ],
        'pdate' => [
            'class' => 'common\components\Pdate'
        ],
        'customHelper' => [
            'class' => 'common\components\CustomHelper'
        ],
    ],
];