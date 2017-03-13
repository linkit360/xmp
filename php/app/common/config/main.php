<?php
$db = file_get_contents('/app/config/db_' . YII_ENV . '.json');
$db = json_decode($db, true);
if (!count($db)) {
    die('Config error' . PHP_EOL);
}

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/../composer/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=' . $db['host'] . ';port=5432;dbname=' . $db['database'],
            'username' => $db['user'],
            'password' => $db['password'],
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
