<?php
function loadConfig(string $filename)
{
    if (!is_file($filename)) {
        echo PHP_EOL . PHP_EOL . 'Config Error: No Config for ' . YII_ENV . ' [' . $filename . ']' . PHP_EOL . PHP_EOL;
        exit(1);
    }

    $cfg = file_get_contents($filename);
    $cfg = json_decode($cfg, true);
    if (!count($cfg)) {
        echo PHP_EOL . PHP_EOL . 'Config Error: Invalid Config' . PHP_EOL . PHP_EOL;
        exit(1);
    }

    return $cfg;
}

# DB Config
$db = loadConfig('/app/config/db.' . YII_ENV . '.json');

# AWS S3 Config
$aws = loadConfig('/app/config/aws.' . YII_ENV . '.json');
defined('AWS_S3') or define('AWS_S3', $aws);

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
            'tablePrefix' => 'xmp_',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // the table for storing authorization items. Defaults to "auth_item".
            'itemTable' => '{{%rbac_items}}',
            // the table for storing authorization item hierarchy. Defaults to "auth_item_child".
            'itemChildTable' => '{{%rbac_items_childs}}',
            // the table for storing authorization item assignments. Defaults to "auth_assignment".
            'assignmentTable' => '{{%rbac_assignments}}',
            // the table for storing rules. Defaults to "auth_rule".
            'ruleTable' => '{{%rbac_rules}}',
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
