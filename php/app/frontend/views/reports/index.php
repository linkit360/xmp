<?php
use kartik\export\ExportMenu;
use yii\grid\GridView;

use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

/**
 * @var yii\web\View                     $this
 * @var frontend\models\Reports\AdReport $model
 */

$this->title = 'Advertising';
$this->params['subtitle'] = 'Report And Chart';
$this->params['breadcrumbs'][] = [
    'label' => 'Reports',
    'url' => '/reports/index',
];
$this->params['breadcrumbs'][] = $this->title;

$excludeColums = [
    'id_campaign',
    'operator_code',
];

$total = [
    'lp_hits' => 0,
    'mo' => 0,
    'mo_success' => 0,
    'pixels' => 0,
    'lp_msisdn_hits' => 0,
    'retry_success' => 0,
];

$dp = $model->dataProviderAd();
if (!empty($dp->getModels())) {
    foreach ($dp->getModels() as $row) {
        foreach ($row as $key => $val) {
            if (in_array($key, $excludeColums) || !is_numeric($val)) {
                continue;
            }

            $total[$key] += $val;
        }
    }
}

$model->getCampaignsLinks();
$gridColumns = [
    [
        'attribute' => 'report_date',
        'headerOptions' => [
            'class' => 'text-right',
            'style' => 'width: 1%; white-space: nowrap;',
        ],
        'contentOptions' => [
            'class' => 'text-right',
            'style' => 'width: 1%; white-space: nowrap;',
        ],
        'content' => function ($data) {
            return date('Y-m-d', strtotime($data['report_at_day']));
        },
    ],
    [
        'attribute' => 'id_campaign',
        'label' => 'Campaign',
        'content' => function ($row) use ($model) {
            if (
                !array_key_exists($row["id_campaign"], $model->campaigns_links) ||
                !array_key_exists($row["id_instance"], $model->instances_links)
            ) {
                return number_format($row['id_campaign']);
            }

            $camp = $model->campaigns_links[$row["id_campaign"]];
            $url = "http://" . $model->instances_links[$row["id_instance"]] . "/" . $camp["link"];

            return Html::a(
                $camp["title"],
                $url,
                [
                    "target" => "_blank",
                    "title" => $url,
                ]
            );
        },
    ],
    [
        'label' => 'Country',
        'content' => function ($row) use ($model) {
            if (array_key_exists($row["id_instance"], $model->getInstancesById())) {
                $prov = $model->getInstancesById()[$row['id_instance']];

                return $model->countries[$model->providers[$prov]['id_country']]['name'];
            }

            return '';
        },
    ],
    [
        'label' => 'Provider',
        'content' => function ($row) use ($model) {
            if (array_key_exists($row["id_instance"], $model->getInstancesById())) {
                $prov = $model->getInstancesById()[$row['id_instance']];

                return $model->providers[$prov]['name'];
            }

            return '';
        },
    ],
    [
        'attribute' => 'id_operator',
        'label' => 'Operator',
        'content' => function ($data) use ($model) {
            if (array_key_exists($data['operator_code'], $model->operatorsByCode)) {
                return $model->operatorsByCode[$data['operator_code']];
            }

            return '';
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
    /*
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
    */
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
            if ($data['lp_hits'] > 0) {
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
            if ($data['lp_hits'] > 0) {
                return number_format($data['pixels'] / $data['lp_hits']);
            }

            return 0;
        },
    ],
];
?>
<div class="col-lg-6">
    <div class="ibox">
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
    <div class="ibox">
        <div class="ibox-title">
            <h5>
                Total Pixels Sent For Period: <?= number_format($model->chart['sum']) ?>
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
    <div class="ibox">
        <div class="ibox-content">
            <?php
            echo Html::tag(
                'div',
                ExportMenu::widget([
                    'dataProvider' => $dp,
                    'columns' => $gridColumns,
                    'fontAwesome' => true,
                    'dropdownOptions' => [
                        'label' => 'Export All',
                        'class' => 'btn btn-default',
                    ],
                ]),
                [
                    'class' => 'pull-right',
                ]
            );

            echo GridView::widget([
                'dataProvider' => $dp,
                'showFooter' => true,
                'columns' => $gridColumns,
            ]);
            ?>
        </div>
    </div>
</div>
