<?php

namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\jui\JuiAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class InspiniaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/theme';

    public $css = [
        'font-awesome/css/font-awesome.css',
        'css/animate.css',
        'css/style.css',
    ];

    public $js = [
        'js/inspinia.js',
        'js/plugins/pace/pace.min.js',
        'js/plugins/metisMenu/jquery.metisMenu.js',
        'js/plugins/slimscroll/jquery.slimscroll.min.js',
    ];

    public $depends = [
        JqueryAsset::class,
        JuiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];
}
