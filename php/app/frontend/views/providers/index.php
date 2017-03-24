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
<div class="content animate-panel">
    <div class="row">
        <div class="hpanel col-lg-6">
            <div class="panel-body">
                <h2>
                    <?= Html::encode($this->title) ?>
                    <?= Html::a('Create Provider', ['create'], ['class' => 'btn btn-success']) ?>
                </h2>

                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'id',
                        'name',
                        'id_country',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
