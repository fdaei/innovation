<?php

return [
    [
        'id' => '1',
        'phone' => '09133995707',
        'created' =>  time(),
        'ip' => '5',
        'code' =>'$2y$13$14isTu37LPVGccFEdmzWKuLKyRwnxk8yfGaCJYdYHsgfoRFRcz./S',
    ],
    [
        'id' => '10',
        'phone' => '09390315708',
        'created' => time(),
        'ip' => '5',
        'code' => Yii::$app->security->generatePasswordHash('5708'),
    ]
];