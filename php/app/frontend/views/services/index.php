<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <p>
                <?= Html::a('Create Service', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php
            echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'title',
                        'description',
                        'id_provider',
                        'id_user',
                        // 'status',
                        // 'created_at',
                        // 'updated_at',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]
            );
            ?>
        </div>
    </div>
</div>
