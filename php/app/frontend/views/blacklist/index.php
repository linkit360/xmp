<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View                           $this
 * @var yii\data\ActiveDataProvider    $dataProvider
 * @var \common\models\MsisdnBlacklist $model
 */

$this->title = 'MSISDN Blacklist';
$this->params['breadcrumbs'][] = $this->title;

$js = "
    var providers_names = [];
    var providers = [];
    var operators_select = $('#msisdnblacklist-id_operator');
    var providers_select = $('#msisdnblacklist-id_provider');
";

$providers = [];
/** @var \common\models\Operators $operator */
foreach ($model->getOperators() as $operator) {
    $providers[$operator->id_provider][$operator->id] = $operator->name;
}

foreach ($providers as $id_provider => $operators) {
    if (count($operators)) {
        $js .= PHP_EOL . 'providers_names[' . $id_provider . '] = "' . $model->getProviders()[$id_provider]['name'] . '";' . PHP_EOL;
        $js .= 'providers[' . $id_provider . '] = []' . PHP_EOL;
        foreach ($operators as $id => $name) {
            $js .= 'providers[' . $id_provider . '][' . $id . '] = "' . $name . '";' . PHP_EOL;
        }
    }
}

$this->registerJs($js, View::POS_END);
$this->registerJs('load_operators();', View::POS_READY);
?>
<!--suppress JSUnusedLocalSymbols, JSUnresolvedVariable -->
<script type="text/javascript">
    function check_msisdn(obj) {
        var input = $(obj);
        input.val(input.val().replace(/\D/g, ''));
    }

    function change_operators(obj) {
        operators_select.empty();
        providers[obj.val()].forEach(function (element, index) {
            operators_select.append($('<option value=' + index + '>' + element + '</option>'));
        });
    }

    function load_operators() {
        providers_select.empty();
        providers_names.forEach(function (element, index) {
            providers_select.append($('<option value=' + index + '>' + element + '</option>'));
        });
        change_operators(providers_select);
    }
</script>

<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <h2 class="font-light m-b-xs">
                <?= Html::encode($this->title) ?>
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="hpanel col-lg-6">
            <div class="panel-body">
                <p>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        Add MSISDN
                    </button>
                </p>

                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'msisdn',
                        [
                            'header' => 'Country',
                            'headerOptions' => [
                                'width' => '140',
                                'class' => 'text-right'
                            ],
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) use ($model) {
                                return $model->getCountries()[$model->getProviders()[$data['id_provider']]['id_country']];
                            }
                        ],
                        [
                            'attribute' => 'id_operator',
                            'headerOptions' => [
                                'width' => '140',
                                'class' => 'text-right'
                            ],
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) use ($model) {
                                return $model->getOperators()[$data['id_operator']]['name'];
                            }
                        ],
                        [
                            'attribute' => 'id_provider',
                            'headerOptions' => [
                                'width' => '140',
                                'class' => 'text-right'
                            ],
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) use ($model) {
                                return $model->getProviders()[$data['id_provider']]['name'];
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'headerOptions' => ['width' => '140'],
                            'content' => function ($data) {
                                return date('Y-m-d H:i:s', strtotime($data->created_at));
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '',
                            'headerOptions' => ['width' => '50'],
                            'template' => '{view}{delete}',
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

<?php
# 'Add MSISDN' Modal window
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header text-center">
                <h4 class="modal-title">
                    Add MSISDN
                </h4>
            </div>

            <?php
            $form = ActiveForm::begin([
                'action' => '/blacklist/create'
            ]);
            ?>
            <div class="modal-body">
                <?php
                echo $form->field($model, 'msisdn')->textInput([
                    'maxlength' => true,
                    'onkeyup' => 'check_msisdn(this);'
                ]);

                echo $form->field($model, 'id_provider')
                    ->dropDownList(
                        [],
                        [
                            'onchange' => 'change_operators($(this));'
                        ]
                    );

                echo $form->field($model, 'id_operator')
                    ->dropDownList([]);
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
