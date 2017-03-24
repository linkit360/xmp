<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                      $this
 * @var \frontend\models\Users\UpdateForm $model
 */

$this->title = 'Update User: ' . $model->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->username, 'url' => ['view', 'id' => $model->user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content animate-panel">
    <div class="row">
        <div class="hpanel">
            <div class="panel-body">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>

                <?php
                $form = ActiveForm::begin();
                echo $form->field($model, 'roles')->checkboxList(
                    $model->getRolessAll(),
                    [
                        'separator' => '<br/>',
                    ]
                );
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
                </div>

                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>
