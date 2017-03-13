<?php
defined('YII_ENV') or define('YII_ENV', getenv('PROJECT_ENV'));

if (YII_ENV === 'dev' || YII_ENV === 'test') {
    error_reporting(-1);
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}

require(__DIR__ . '/../../../composer/vendor/autoload.php');
require(__DIR__ . '/../../../composer/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

(new yii\web\Application($config))->run();
