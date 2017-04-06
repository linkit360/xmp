<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

$AwsS3Credentials = new Aws\Credentials\Credentials(
    'AKIAILRGTUB6EBNVUPFA',
    '8Hf/b4jldspVA2hCUlBqAJhmpCjr7M1zAU/LYjrl'
);
