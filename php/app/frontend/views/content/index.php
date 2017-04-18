<?php
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Content';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-6">
    <div class="ibox">
        <div class="ibox-content">
            <p>
                <?= Html::a('Add Content', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Categories', '/content-categories/index', ['class' => 'btn btn-info']) ?>
                <?= Html::a('Publishers', '/content-publishers/index', ['class' => 'btn btn-info']) ?>
            </p>

            <?php
            echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        //'id_user',
                        'id_category',
                        'id_publisher',
                        'title',
                        // 'status',
                        // 'time_create',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]
            );
            ?>
        </div>
    </div>
</div>
