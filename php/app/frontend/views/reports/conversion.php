<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\ReportsForm $model
 */

$this->title = 'Conversion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content animate-panel">
    <div class="row">
        <div class="hpanel">
            <?php
            $form = ActiveForm::begin([
                'action' => '/reports/conversion',
                'method' => 'get',
            ]);
            ?>
            <div class="panel-body">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

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
                            ]
                        ]);

                        echo '<br/>' . Html::submitButton('Search', [
                                'class' => 'btn btn-info'
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>

    <div class="row">
        <div class="hpanel">
            <div class="panel-body">
                <?php
                echo GridView::widget([
                    'dataProvider' => $model->dataProviderConv(),
                    'columns' => [
                        [
                            'attribute' => 'report_date',
                            'content' => function ($data) {
                                return date('Y-m-d', strtotime($data['report_at_day']));
                            }
                        ],
                        'id_campaign',
                        [
                            'attribute' => 'lp_hits',
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) {
                                return number_format($data['lp_hits']);
                            }
                        ],
                        [
                            'attribute' => 'lp_msisdn_hits',
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) {
                                return number_format($data['lp_msisdn_hits']);
                            }
                        ],
                        [
                            'attribute' => 'mo',
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) {
                                return number_format($data['mo']);
                            }
                        ],
                        [
                            'attribute' => 'mo_success',
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) {
                                return number_format($data['mo_success']);
                            }
                        ],
                        [
                            'label' => 'Conversion Rate',
                            'content' => function ($data) {
                                $conv = 0;
                                if ($data['lp_hits']) {
                                    $conv = number_format($data['mo'] / $data['lp_hits'] * 100, 2);
                                }
                                return $conv . '%';
                            },
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>