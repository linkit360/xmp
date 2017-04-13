<?php
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Providers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-6">
    <div class="ibox">
        <div class="ibox-content">
            <?php
            echo Html::a(
                'Create Provider',
                ['create'],
                ['class' => 'btn btn-success']
            );

            echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'name',
                        'name_alias',
                        'id_country',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]
            );
            ?>
        </div>
    </div>
</div>
