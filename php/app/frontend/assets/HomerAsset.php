<?php
namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\jui\JuiAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class HomerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/homer';

    public $css = [
        'fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css',
        'fonts/pe-icon-7-stroke/css/helper.css',
        'vendor/fontawesome/css/font-awesome.css',
        'vendor/metisMenu/dist/metisMenu.css',
        'vendor/animate.css/animate.css',
        'css/style.css',
    ];

    public $js = [
        'js/homer.js',
        'vendor/slimScroll/jquery.slimscroll.min.js',
        'vendor/metisMenu/dist/metisMenu.min.js',
    ];

    public $depends = [
        JqueryAsset::class,
        JuiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];
}
