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
<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_lp">
                0
            </h1>

            LP Hits
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_mo">
                0
            </h1>

            Total MO
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_mos">
                0
            </h1>

            Success MO
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_conv">
                0
            </h1>

            Conversion Rate
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <?php
            $this->registerJsFile(
                'http://code.highcharts.com/mapdata/custom/world-eckert3-lowres.js',
                [
                    'depends' => 'miloschuman\highcharts\HighchartsAsset',
                ]
            );

            $countries = \common\models\Countries::find()
                ->select([
                    'lower(iso) as iso',
                ])
                ->asArray()
                ->all();

            $data = [];
            foreach ($countries as $country) {
                $data[] = ['hc-key' => $country['iso'], 'value' => 0];
            }

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
                            'data' => $data,
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
</div>
