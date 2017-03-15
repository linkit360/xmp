<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reports', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'report_date',
            'id_campaign',
            'id_provider',
            'id_operator',
            // 'lp_hits',
            // 'lp_msisdn_hits',
            // 'mo',
            // 'mo_uniq',
            // 'mo_success',
            // 'pixels',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
