<?php
use common\components\Env;
 $logTargetMaskedVars = [
    '_SERVER.HTTP_AUTHORIZATION',
    '_SERVER.PHP_AUTH_USER',
    '_SERVER.PHP_AUTH_PW',
    '_SERVER.SMS_WHITE_LIST',
    '_SERVER.GOOGLE_CLIENT_ID',
    '_SERVER.GOOGLE_CLIENT_SECRET',
    '_SERVER.SERVER_IP_ADDRESS',
    '_SERVER.GOOGLE_SITE_KEY',
    '_SERVER.GOOGLE_SITE_SECRET',
    '_SERVER.MOBIT_FCM_API_KEY',
    '_SERVER.MOBIT_WEB_FCM_API_KEY',
    '_SERVER.MOBIT_WEB_FCM_SENDER',
    '_SERVER.PAY_BUY_FCM_API_KEY',
    '_SERVER.DELIVERY_FCM_API_KEY',
    '_SERVER.TELEGRAM_BOT_TOKEN',
    '_SERVER.SMS_LOG_TARGET_RECEPTORS',
    '_SERVER.DB_USERNAME',
    '_SERVER.DB_PASSWORD',
    '_SERVER.DB_TABLE_PREFIX',
    '_SERVER.SLAVE_DB_USERNAME',
    '_SERVER.SLAVE_DB_PASSWORD',
    '_SERVER.SECONDARY_DB_USERNAME',
    '_SERVER.SECONDARY_DB_PASSWORD',
    '_SERVER.SECONDARY_DB_TABLE_PREFIX',
    '_SERVER.BACKEND_COOKIE_VALIDATION_KEY',
    '_SERVER.FRONTEND_COOKIE_VALIDATION_KEY',
    '_SERVER.PAY_BUY_COOKIE_VALIDATION_KEY',
    '_SERVER.OPENSEARCH_USER',
    '_SERVER.OPENSEARCH_PASS',
    '_SERVER.POST_ECOMMERCE_USERNAME',
    '_SERVER.POST_ECOMMERCE_PASSWORD',
    '_SERVER.POST_ECOMMERCE_SECRET_KEY',
    '_SERVER.DEBUG_PANEL_ALLOWED_IPS',
    '_SERVER.MAILER_USERNAME',
    '_SERVER.MAILER_PASSWORD',
];
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
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'common\models\User',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',

                ]
            ]
        ]
    ],
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://developer:password@localhost:27017/mydatabase',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
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
        'Cdn' => [
            'class' => 'common\components\Cdn',
        ],
    ],


];