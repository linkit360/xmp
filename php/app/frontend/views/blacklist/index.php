<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var yii\data\ActiveDataProvider    $dataProvider
 * @var \common\models\MsisdnBlacklist $model
 */

$this->title = 'MSISDN Blacklist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content animate-panel">
    <div class="row">
        <div class="hpanel">
            <div class="panel-body">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

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
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) use ($model) {
                                return $model->countries[$model->providers[$data['id_provider']]['id_country']];
                            }
                        ],
                        [
                            'attribute' => 'id_operator',
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) use ($model) {
                                return $model->operators[$data['id_operator']];
                            }
                        ],
                        [
                            'attribute' => 'id_provider',
                            'contentOptions' => function () {
                                return ['class' => 'text-right'];
                            },
                            'content' => function ($data) use ($model) {
                                return $model->providers[$data['id_provider']]['name'];
                            }
                        ],
                        'created_at',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '',
                            'headerOptions' => ['width' => '80'],
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
                echo $form->field($model, 'msisdn')->textInput(['maxlength' => true]);
                echo $form->field($model, 'id_provider')
                    ->dropDownList(ArrayHelper::map($model->providers, 'id', 'name'));
                echo $form->field($model, 'id_operator')->dropDownList($model->operators);
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
