<?php
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Operators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpanel col-lg-6">
    <div class="panel-body">
        <p>
            <?= Html::a('Create Operator', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
//                'id',
                'name',
                'id_provider',
//                'isp',
//                'msisdn_prefix',
                'mcc',
                'mnc',
                'status',
//                'code',
                'created_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
</div>
