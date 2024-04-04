<?php

use common\components\Env;

return [
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
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => Env::get('REDIS_HOST_NAME'),
            'port' => Env::get('REDIS_PORT', 6379),
            'database' => Env::get('REDIS_DATABASE', 0)
        ],
    ]
];