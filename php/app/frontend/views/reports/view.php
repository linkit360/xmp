<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reports */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
    ]) ?>

</div>
