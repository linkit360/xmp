<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/../composer/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
