<?php
return [
    'id' => 'app-backend-tests',
    'basePath' => realpath(__DIR__ . '/../'),
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],

];
