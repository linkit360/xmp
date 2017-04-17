<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-6">
    <div class="ibox">
        <div class="ibox-content">
            <p>
                <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
//                    'id_user',
                    'icon',
                    'title',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
