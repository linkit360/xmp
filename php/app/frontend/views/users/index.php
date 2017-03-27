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
<div class="content animate-panel row">
    <div class="hpanel col-lg-6">
        <div class="panel-body">
            <h2>
                <?php
                echo Html::encode($this->title);
                if (Yii::$app->user->can('usersCreate')) {
                    echo '&nbsp;' . Html::a('Create User', ['create'], ['class' => 'btn btn-success']);
                }
                ?>
            </h2>

            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'username',
//                    'auth_key',
//                    'password_hash',
//                    'password_reset_token',
                    'email:email',
//                    [
//                        'header' => 'Roles',
//                        'content' => function ($data) {
//                            return '1';
//                        },
//                    ],
//                    'status',
                    'created_at:datetime',
                    'updated_at:datetime',
//                    'id',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
