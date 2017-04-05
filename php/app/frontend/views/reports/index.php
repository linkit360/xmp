<?php
use yii\grid\GridView;

use miloschuman\highcharts\Highcharts;

/**
 * @var yii\web\View                $this
 * @var frontend\models\ReportsForm $model
 */

$this->title = 'Advertising';
$this->params['subtitle'] = 'Report And Chart';
$this->params['breadcrumbs'][] = [
    'label' => 'Reports',
    'url' => '/reports/index',
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Filter
            </h5>
        </div>

        <div class="ibox-content">
            <?php
            echo $this->render(
                'filter',
                [
                    'model' => $model,
                ]
            );
            ?>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Total Lp Hits For Period: <?= number_format($model->chart['sum']) ?>
            </h5>
        </div>

        <div class="ibox-content">
            <?php
            if (array_key_exists('sum', $model->chart) && $model->chart['sum'] > 0) {
                echo Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'height' => 235,
                            'zoomType' => 'x',
                            'type' => 'column',
                        ],
                        'title' => [
                            'useHTML' => true,
                            'text' => '',
                        ],
                        'plotOptions' => [
                            'series' => [
                                'fillOpacity' => 0.7,
                                'lineWidth' => 2,
                            ],
                        ],
                        'xAxis' => [
                            'gridLineColor' => '#BFC8CE',
                            'gridLineDashStyle' => 'shortdash',
                            'gridLineWidth' => '1',
                            'min' => 0,
                            'tickmarkPlacement' => 'on',
                            'categories' => $model->chart['days'],
                        ],
                        'yAxis' => [
                            'gridLineColor' => '#BFC8CE',
                            'gridLineDashStyle' => 'shortdash',
                            'gridLineWidth' => '1',
                            'title' => ['text' => 'Lp Hits'],
                        ],
                        'credits' => ['enabled' => false],
                        'series' => $model->chart['series'],
                    ],
                ]);
            } else {
                echo '<div style="text-align: center;">No data.</div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <?php
            $dp = $model->dataProviderAd();
            $excludeColums = [
                'id_campaign',
                'operator_code',
            ];
            $total = [];
            if (!empty($dp->getModels())) {
                foreach ($dp->getModels() as $row) {
                    foreach ($row as $key => $val) {
                        if (in_array($key, $excludeColums) || !is_numeric($val)) {
                            continue;
                        }

                        if (!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }

                        $total[$key] += $val;
                    }
                }
            }

            echo GridView::widget([
                'dataProvider' => $dp,
                'showFooter' => true,
                'columns' => [
                    [
                        'attribute' => 'report_date',
                        'content' => function ($data) {
                            return date('Y-m-d', strtotime($data['report_at_day']));
                        },
                    ],
                    'id_campaign',
                    [
                        'label' => 'Country',
                        'content' => function ($data) use ($model) {
                            return $model->countries[$model->providersByNamesCountry[$data['provider_name']]]['name'];
                        },
                    ],
                    [
                        'attribute' => 'id_provider',
                        'label' => 'Provider',
                        'content' => function ($data) use ($model) {
                            return $model->providersByNames[$data['provider_name']];
                        },
                    ],
                    [
                        'attribute' => 'id_operator',
                        'label' => 'Operator',
                        'content' => function ($data) use ($model) {
                            return $model->operatorsByCode[$data['operator_code']];
                        },
                    ],
                    [
                        'attribute' => 'lp_hits',
                        'label' => 'LP Hits',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['lp_hits']);
                        },
                        'footerOptions' => [
                            'class' => 'text-right',
                            'style' => 'font-weight: bold;',
                        ],
                        'footer' => number_format($total['lp_hits']),
                    ],
                    /*
                    [
                        'attribute' => 'lp_msisdn_hits',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['lp_msisdn_hits']);
                        },
                    ],
                    */
                    [
                        'attribute' => 'mo',
                        'label' => 'MO',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['mo']);
                        },
                        'footerOptions' => [
                            'class' => 'text-right',
                            'style' => 'font-weight: bold;',
                        ],
                        'footer' => number_format($total['mo']),
                    ],
                    [
                        'attribute' => 'mo_uniq',
                        'label' => 'MO Unique',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['mo_uniq']);
                        },
                        'footerOptions' => [
                            'class' => 'text-right',
                            'style' => 'font-weight: bold;',
                        ],
                        'footer' => number_format($total['mo_uniq']),
                    ],
                    [
                        'attribute' => 'mo_success',
                        'label' => 'MO Success',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['mo_success']);
                        },
                        'footerOptions' => [
                            'class' => 'text-right',
                            'style' => 'font-weight: bold;',
                        ],
                        'footer' => number_format($total['mo_success']),
                    ],
                    /*
                    [
                        'attribute' => 'retry_success',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['retry_success']);
                        },
                    ],
                    */
                    [
                        'label' => 'Conversion Rate',
                        'contentOptions' => function () {
                            return [
                                'class' => 'text-right',
                                'style' => 'background-color: #b3e6ff',
                            ];
                        },
                        'content' => function ($data) {
                            $conv = 0;
                            if ($data['lp_hits']) {
                                $conv = number_format(
                                    $data['mo'] / $data['lp_hits'] * 100,
                                    2
                                );
                            }
                            return '<b>' . $conv . '</b>%';
                        },
                    ],
                    [
                        'attribute' => 'pixels',
                        'label' => 'Pixels Sent',
                        'contentOptions' => function () {
                            return [
                                'class' => 'text-right',
                                'style' => 'background-color: #b3e6ff',
                            ];
                        },
                        'content' => function ($data) {
                            return number_format($data['pixels']);
                        },
                        'footerOptions' => [
                            'class' => 'text-right',
                            'style' => 'font-weight: bold;',
                        ],
                        'footer' => number_format($total['pixels']),
                    ],
                    [
                        'label' => 'Pixels Rate',
                        'contentOptions' => function () {
                            return [
                                'class' => 'text-right',
                                'style' => 'background-color: #99ddff',
                            ];
                        },
                        'content' => function ($data) {
                            return number_format($data['pixels'] / $data['lp_hits']);
                        },
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
