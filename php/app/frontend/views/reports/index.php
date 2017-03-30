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
<div class="hpanel col-lg-6">
    <div class="panel-body">
        <h4>
            Filter
        </h4>

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

<div class="hpanel col-lg-6">
    <div class="panel-body">
        <h4 class="text-center">
            Total Lp Hits For Period: <?= $model->chart['sum'] ?>
        </h4>
        <?php
        if (array_key_exists('sum', $model->chart) && $model->chart['sum'] > 0) {
            echo Highcharts::widget([
                'options' => [
                    'chart' => [
                        'height' => 230,
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

<div class="hpanel col-lg-12">
    <div class="panel-body">
        <?php
        echo GridView::widget([
            'dataProvider' => $model->dataProviderAd(),
            'columns' => [
                [
                    'attribute' => 'report_date',
                    'content' => function ($data) {
                        return date('Y-m-d', strtotime($data['report_at_day']));
                    },
                ],
                'id_campaign',
                [
                    'attribute' => 'id_provider',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) use ($model) {
                        return $model->providersByNames[$data['provider_name']];
                    },
                ],
                [
                    'attribute' => 'id_operator',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) use ($model) {
                        return $model->operatorsByCode[$data['operator_code']];
                    },
                ],
                [
                    'attribute' => 'lp_hits',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['lp_hits']);
                    },
                ],
                [
                    'attribute' => 'lp_msisdn_hits',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['lp_msisdn_hits']);
                    },
                ],
                [
                    'attribute' => 'mo',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['mo']);
                    },
                ],
                [
                    'attribute' => 'mo_uniq',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['mo_uniq']);
                    },
                ],
                [
                    'attribute' => 'mo_success',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['mo_success']);
                    },
                ],
                [
                    'attribute' => 'retry_success',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['retry_success']);
                    },
                ],
                [
                    'attribute' => 'pixels',
                    'contentOptions' => function () {
                        return ['class' => 'text-right'];
                    },
                    'content' => function ($data) {
                        return number_format($data['pixels']);
                    },
                ],
            ],
        ]);
        ?>
    </div>
</div>
