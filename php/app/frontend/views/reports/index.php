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

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;

\yii\bootstrap\BootstrapAsset::register($this);
?>
<h1>
    <?= Html::encode($this->title) ?>
</h1>

<div class="row">
    <div class="col-md-6">
        <?php
        $form = ActiveForm::begin([
            'method' => 'get',
            'options' => [
                'class' => 'form-horizontal',
            ],
        ]);

        echo $form->field($model, 'country')->dropDownList($model->countries);
        echo $form->field($model, 'operator')->dropDownList($model->operators);
        echo $form->field($model, 'provider')->dropDownList($model->providers);
        echo $form->field($model, 'campaign')->dropDownList($model->campaigns);

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

        echo Html::submitButton('Search');
        ActiveForm::end();
        ?>
    </div>

    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $model->dataProvider(),
            'columns' => [
                'report_date',
                'id_campaign',
                'id_provider',
                'id_operator',
                'lp_hits',
                'lp_msisdn_hits',
                'mo',
                'mo_uniq',
                'mo_success',
                'pixels',
            ],
        ]);
        ?>
    </div>
</div>
