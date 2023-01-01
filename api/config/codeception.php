<?php

return yii\helpers\ArrayHelper::merge(
	require dirname(__DIR__, 2) . '/common/config/codeception.php',
	require __DIR__ . '/main.php',
	require __DIR__ . '/main-extra.php',
	require __DIR__ . '/test-extra.php',
	[

	]
);