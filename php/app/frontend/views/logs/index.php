<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Transactions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'sent_at',
            'tid',
            'msisdn',
            // 'id_country',
            // 'id_service',
            // 'id_campaign',
            // 'id_subscription',
            // 'id_content',
            // 'id_operator',
            // 'operator_token',
            // 'price',
            // 'result',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
