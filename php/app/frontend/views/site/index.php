<?php
/**
 * @var $this yii\web\View
 */

use yii\web\JsExpression;
use miloschuman\highcharts\Highmaps;

use frontend\assets\DashboardAsset;

DashboardAsset::register($this);

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Reports and Stats for Today';
$this->params['breadcrumbs'][] = $this->title;

$host = 'test.xmp2.linkit360.ru';
if (YII_ENV === "dev") {
    $host = "127.0.0.1";
}

$this->registerJs('server = "ws://' . $host . ':3000/echo";');
?>
<div class="hpanel col-md-3">
    <div class="panel-body">
        <div class="stats-title pull-left">
            <h4>LP Hits</h4>
        </div>

        <div class="stats-icon pull-right">
            <i class="pe-7s-shuffle fa-4x"></i>
        </div>

        <div class="m-t-xl">
            <h1 class="text-info" id="output_lp">0</h1>
        </div>
    </div>
</div>

<div class="hpanel col-md-3">
    <div class="panel-body">
        <div class="stats-title pull-left">
            <h4>Total MO</h4>
        </div>

        <div class="stats-icon pull-right">
            <i class="pe-7s-shuffle fa-4x"></i>
        </div>

        <div class="m-t-xl">
            <h1 class="text-info" id="output_mo">0</h1>
        </div>
    </div>
</div>

<div class="hpanel col-md-3">
    <div class="panel-body">
        <div class="stats-title pull-left">
            <h4>Success MO</h4>
        </div>

        <div class="stats-icon pull-right">
            <i class="pe-7s-shuffle fa-4x"></i>
        </div>

        <div class="m-t-xl">
            <h1 class="text-info" id="output_mos">0</h1>
        </div>
    </div>
</div>

<div class="hpanel col-md-3">
    <div class="panel-body">
        <div class="stats-title pull-left">
            <h4>Conversion Rate</h4>
        </div>

        <div class="stats-icon pull-right">
            <i class="pe-7s-shuffle fa-4x"></i>
        </div>

        <div class="m-t-xl">
            <h1 class="text-info" id="output_conv">0</h1>
        </div>
    </div>
</div>

<div class="hpanel col-md-12">
    <div class="panel-body">
        <?php
        $this->registerJsFile(
            'http://code.highcharts.com/mapdata/custom/world-eckert3-lowres.js',
            [
                'depends' => 'miloschuman\highcharts\HighchartsAsset',
            ]
        );

        echo Highmaps::widget([
            'id' => 'hmap',
            'options' => [
                'title' => [
                    'text' => 'Incoming Traffic. World area (LP pages shown)',
                ],
                'mapNavigation' => [
                    'enableMouseWheelZoom' => false,
                    'enabled' => true,
                    'buttonOptions' => [
                        'verticalAlign' => 'bottom',
                    ],
                ],
                'chart' => [
//                    'width' => 100%,
                    'height' => 600,
                ],
                'colorAxis' => [
                    'min' => 5,
                ],
                'series' => [
                    [
                        'data' => [
//                            ['hc-key' => 'id', 'value' => $model->countries_data['Indonesia']['total_lp_click']],
//                            ['hc-key' => 'th', 'value' => $model->countries_data['Thailand']['total_lp_click']],
//                            ['hc-key' => 'pk', 'value' => $model->countries_data['Pakistan']['total_lp_click']],
//                            ['hc-key' => 'ru', 'value' => $model->countries_data['Russia']['total_lp_click']],
//                            ['hc-key' => 'br', 'value' => $model->countries_data['Brazil']['total_lp_click']],
//                            ['hc-key' => 'eg', 'value' => $model->countries_data['Egypt']['total_lp_click']],
//                            ['hc-key' => 'id', 'value' => 2],
//                            ['hc-key' => 'th', 'value' => 3],
//                            ['hc-key' => 'pk', 'value' => 1],
//                            ['hc-key' => 'ru', 'value' => 10],
//                            ['hc-key' => 'br', 'value' => 0],
//                            ['hc-key' => 'eg', 'value' => 0],
                        ],
                        'mapData' => new JsExpression('Highcharts.maps["custom/world-eckert3-lowres"]'),
                        'joinBy' => 'hc-key',
                        'name' => 'Incoming Traffic (LP pages shown)',
                        'allowPointSelect' => true,
                        'cursor' => 'pointer',
                        'states' => [
                            'select' => [
                                'color' => '#a4edba',
                            ],
                        ],
                        'dataLabels' => [
                            'enabled' => true,
                            'format' => '{point.name}',
                        ],
                    ],
                ],
            ],
        ]);
        ?>
    </div>
</div>
