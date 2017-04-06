<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View      $this
 * @var common\models\Lps $model
 */

$this->title = 'Landing Page';
$this->params['breadcrumbs'][] = ['label' => 'Landing Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Download', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?php
            DetailView::widget(
                [
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'id_user',
                        'status',
                        'created_at',
                        'updated_at',
                    ],
                ]
            );
            ?>
        </div>
    </div>
</div>
