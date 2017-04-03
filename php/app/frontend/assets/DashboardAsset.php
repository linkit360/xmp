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
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/dashboard.js',
    ];
    public $depends = [
        InspiniaAsset::class,
    ];
}
