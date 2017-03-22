<?php
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Users';
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
                    <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
//                        ['class' => 'yii\grid\SerialColumn'],

                        'username',
//                        'auth_key',
//                        'password_hash',
//                        'password_reset_token',
                        'email:email',
                        'status',
                        'created_at',
                        'updated_at',

                        'id',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
