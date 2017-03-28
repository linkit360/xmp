<?php
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/**
 * @var yii\web\View                $this
 * @var frontend\models\ReportsForm $model
 */

$this->title = 'Conversion';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider = $model->dataConv();
?>
<div class="content animate-panel">
    <div class="hpanel col-lg-6">
        <?php
        $form = ActiveForm::begin([
            'action' => '/reports/conversion',
            'method' => 'get',
        ]);
        ?>
        <div class="panel-body">
            <h2>
                <?= Html::encode($this->title) ?>
            </h2>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'country')->dropDownList($model->countries) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'operator')->dropDownList($model->operators) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'provider')->dropDownList($model->providers) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'campaign')->dropDownList($model->campaigns) ?>
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

                    echo '<br/>' . Html::submitButton('Search', [
                            'class' => 'btn btn-info',
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>

    <div class="hpanel col-lg-6">
        <div class="panel-body">
            <?php
            if (array_key_exists('sum', $model->chart) && $model->chart['sum'] > 0) {
                echo Highcharts::widget([
                    'options' => [
                        'chart' => [
                            'zoomType' => 'x',
                            'type' => 'column',
                        ],
                        'title' => [
                            'useHTML' => true,
                            'text' => 'Total Lp Hits For Period: ' . $model->chart['sum'],
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
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'report_date',
                        'content' => function ($data) {
                            return date('Y-m-d', strtotime($data['report_at_day']));
                        },
                    ],
                    [
                        'attribute' => 'id_campaign',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['id_campaign']);
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
                        'attribute' => 'mo_success',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
                        },
                        'content' => function ($data) {
                            return number_format($data['mo_success']);
                        },
                    ],
                    [
                        'label' => 'Conversion Rate',
                        'contentOptions' => function () {
                            return ['class' => 'text-right'];
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
                ],
            ]);
            ?>
        </div>
    </div>
</div>
