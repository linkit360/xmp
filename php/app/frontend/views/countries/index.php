<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-6">
    <div class="ibox">
        <div class="ibox-content">
            <?php
            echo Html::a(
                'Create Country',
                ['create'],
                ['class' => 'btn btn-success']
            );

            echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'name',
                        'code',
//                        'status',
                        'iso',
                        'priority',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'headerOptions' => [
                                'style' => 'width: 66px;',
                            ],
                        ],
                    ],
                ]
            );
            ?>
        </div>
    </div>
</div>
