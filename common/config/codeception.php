<?php

use Dotenv\Dotenv;

$dotEnv = Dotenv::createImmutable(__DIR__ . '/../../env-config-test');
$dotEnv->load();

return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/test.php',
    require __DIR__ . '/test-extra.php',
);