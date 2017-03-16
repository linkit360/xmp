<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View            $this
 * @var common\models\Operators $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Operators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content animate-panel">
    <div class="row">
        <div class="hpanel">
            <div class="panel-body">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?php
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'id_provider',
                        'isp',
                        'msisdn_prefix',
                        'mcc',
                        'mnc',
                        'status',
                        'code',
                        'created_at',
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
