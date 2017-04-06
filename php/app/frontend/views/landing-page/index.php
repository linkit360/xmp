<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Landing Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <p>
                <?= Html::a('Create Lp', ['designer'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'id_user',
                    'status',
                    'created_at',
                    'updated_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
