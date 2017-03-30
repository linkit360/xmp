<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

use kartik\widgets\DatePicker;
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
<script type="text/javascript">
    var struct = {};
    <?= 'struct = ' . json_encode($model->getStruct(), JSON_PRETTY_PRINT) . ';' ?>

    function checkForm(obj) {
        var country = $('#reportsform-country');
        var provider = $('#reportsform-provider');
        var operator = $('#reportsform-operator');

        var countryId = parseInt(country.val());
        var providerId = parseInt(provider.val());

        if ($(obj).attr('id') === 'reportsform-country') {
            provider.empty();
            provider.append($('<option value=0>All</option>'));

            operator.empty();
            operator.append($('<option value=0>All</option>'));

            if (countryId !== 0) {
                $.each(struct[countryId]['items'], function (index, value) {
                    provider.append($('<option value=' + index + '>' + value['name'] + '</option>'));
                });
            }

            return true;
        }

        if ($(obj).attr('id') === 'reportsform-provider') {

            operator.empty();
            operator.append($('<option value=0>All</option>'));

            if (providerId !== 0) {
                $.each(struct[countryId]['items'][providerId]['items'], function (index, value) {
                    operator.append($('<option value=' + index + '>' + value + '</option>'));
                });
            }

            return true;
        }

        return false;
    }
    //    checkForm();
</script>

<div class="hpanel col-lg-6">
    <div class="panel-body">
        <h4>
            Filter
        </h4>

        <?php
        $form = ActiveForm::begin([
            'action' => '/reports/index',
            'method' => 'get',
        ]);
        ?>

        <div class="row">
            <div class="col-md-6">
                <?php
                echo $form
                    ->field($model, 'country')
                    ->dropDownList(
                        [0 => 'All'] +
                        ArrayHelper::map(
                            $model->getCountries(),
                            'id',
                            'name'
                        ),
                        [
                            'onchange' => 'checkForm(this);',
                        ]
                    );
                ?>
            </div>

            <div class="col-md-6">
                <?php
                $providers = [];
                if ($model->country !== "0") {
                    foreach ($model->getStruct()[$model->country]['items'] as $providerId => $provider) {
                        $providers[$providerId] = $provider['name'];
                    }
                }

                echo $form
                    ->field($model, 'provider')
                    ->dropDownList(
                        [0 => 'All'] + $providers,
                        [
                            'onchange' => 'checkForm(this);',
                        ]
                    );
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php
                $operators = [];
                if ($model->country !== "0" and $model->provider !== "0") {
                    $operators = $model->getStruct()[$model->country]['items'][$model->provider]['items'];
                }

                echo $form
                    ->field($model, 'operator')
                    ->dropDownList(
                        [0 => 'All'] + $operators,
                        [
                            'onchange' => 'checkForm(this);',
                        ]
                    );
                ?>
            </div>

            <div class="col-md-6">
                <?php
                echo $form
                    ->field($model, 'campaign')
                    ->dropDownList(
                        [0 => 'All'] +
                        $model->getCampaigns()
                    );
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                echo DatePicker::widget([
                    'type' => DatePicker::TYPE_RANGE,
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'dateFrom',
                    'attribute2' => 'dateTo',
                    'options' => ['placeholder' => 'Start date'],
                    'options2' => ['placeholder' => 'End date'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ],
                ]);

                echo '<br/>';
                echo Html::submitButton(
                    'Search',
                    [
                        'class' => 'btn btn-info',
                    ]
                );
                ?>
            </div>
        </div>
        <?php
        ActiveForm::end();
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
