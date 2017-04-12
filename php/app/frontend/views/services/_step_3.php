<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View           $this
 * @var common\models\Services $model
 * @var yii\widgets\ActiveForm $form
 */

$this->params['subtitle'] = 'Service Info';
?>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    Service Info
                </h5>
            </div>

            <div class="ibox-content">
                Empty for now.
            </div>
        </div>
    </div>
<?php
/*
$form = ActiveForm::begin();
?>

<?= $form->field($model, 'id')->textInput() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'id_provider')->textInput() ?>

<?= $form->field($model, 'id_user')->textInput() ?>

<?= $form->field($model, 'status')->textInput() ?>

<?= $form->field($model, 'created_at')->textInput() ?>

<?= $form->field($model, 'updated_at')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php
ActiveForm::end();
*/
