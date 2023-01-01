<?php

use common\components\Env;

$config = [

	'name' => 'Innovation Center',
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => Env::get('BACKEND_COOKIE_VALIDATION_KEY'),
		],
	],
];

return $config;