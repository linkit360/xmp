<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use app\assets\InspiniaAsset;

/**
 * Frontend dashboard asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $sourcePath = __DIR__;

    public $css = [
    ];

    public $js = [
        'dashboard/dashboard.js',
        'theme/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js',
        'theme/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    ];

    public $depends = [
        InspiniaAsset::class,
    ];
}
