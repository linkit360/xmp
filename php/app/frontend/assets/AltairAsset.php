<?php
namespace app\assets;

use yii\web\AssetBundle;

class AltairAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'altair/assets/css/main.css',
        'altair/bower_components/uikit/css/uikit.almost-flat.css',

    ];

    public $cssOptions = [
        'media' => 'all'
    ];

//    public $jsOptions = array(
//        'position' => \yii\web\View::POS_HEAD
//    );

    public $js = [
        'altair/assets/js/common.js',
        'altair/assets/js/uikit_custom.js',
        'altair/assets/js/altair_admin_common.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
