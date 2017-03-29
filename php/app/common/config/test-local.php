<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/test.php'),
    [
        'components' => [
            'db' => [
                'dsn' => 'pgsql:host=pgsql;dbname=yii2advanced_test',
            ]
        ],
    ]
);
