<?php

use common\components\Env;

$config = [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@inceRoot' => Env::get('INCE_ROOT'),
        '@inceWeb' => Env::get('INCE_WEB'),
        '@cdnRoot' => Env::get('CDN_ROOT'),
        '@cdnWeb' => Env::get('CDN_WEB')
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => Env::get('DB_DSN'),
            'username' => Env::get('DB_USERNAME'),
            'password' => Env::get('DB_PASSWORD'),
            'enableSlaves' => Env::get('ENABLE_SLAVES'),
            'slaveConfig' => [
                'username' => Env::get('SLAVE_DB_USERNAME'),
                'password' => Env::get('SLAVE_DB_PASSWORD'),
                'attributes' => [
                    // use a smaller connection timeout
                    PDO::ATTR_TIMEOUT => 10,
                ],
            ],
            'slaves' => [
                ['dsn' => Env::get('FIRST_SLAVE_DB_DSN')],
                ['dsn' => Env::get('SECOND_SLAVE_DB_DSN')],
            ],
            'charset' => Env::get('DB_CHARSET', 'utf8'),
            'tablePrefix' => Env::get('DB_TABLE_PREFIX'),
            'enableQueryCache' => Env::get('DB_ENABLE_QUERY_CACHE', true),
            'queryCacheDuration' => Env::get('DB_QUERY_CACHE_DURATION', 5), // five seconds
            
            'enableSchemaCache' => Env::get('DB_ENABLE_SCHEMA_CACHE', true),
            // Duration of schema cache.
            'schemaCacheDuration' => Env::get('DB_SCHEMA_CACHE_DURATION', 86400), // 3600*24, 1DAY
            // Name of the cache component used to store schema information
            'schemaCache' => Env::get('DB_SCHEMA_CACHE_COMPONENT', 'cache'),
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => Env::get('BACKEND_BASE_URL'),
        ],
        'urlManagerBackendTest' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => Env::get('BACKEND_TEST_BASE_URL', 'https://backend.mobittest.ir/'),
        ],
        'urlManagerBackendLocal' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => Env::get('BACKEND_LOCAL_BASE_URL', 'http://localhost/mobit/backend/web/'),
        ],
        'urlManagerApi' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => Env::get('API_BASE_URL','https://api.mobit.ir/api/web/'),
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => Env::get('FRONTEND_BASE_URL'),
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'collapseSlashes' => true,
                'normalizeTrailingSlash' => true,
            ],
            'rules' => [
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ]
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => Env::get('REDIS_HOST_NAME'),
            'port' => Env::get('REDIS_PORT', 6379),
            'database' => Env::get('REDIS_DATABASE', 0)
        ],
    ],
];

if (YII_ENV_DEV) {
    //use symbolic link to publish asset files. useful during development.
    $config['components']['assetManager']['linkAssets'] = true;

	$config['modules'] = [
		'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['127.0.0.1', '::1'],
			'generators' => [

			],
		]
	];
}

return $config;