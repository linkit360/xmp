<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'report_date')->textInput() ?>

    <?= $form->field($model, 'id_campaign')->textInput() ?>

    <?= $form->field($model, 'id_provider')->textInput() ?>

    <?= $form->field($model, 'id_operator')->textInput() ?>

    <?= $form->field($model, 'lp_hits')->textInput() ?>

    <?= $form->field($model, 'lp_msisdn_hits')->textInput() ?>

    <?= $form->field($model, 'mo')->textInput() ?>

    <?= $form->field($model, 'mo_uniq')->textInput() ?>

    <?= $form->field($model, 'mo_success')->textInput() ?>

    <?= $form->field($model, 'pixels')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
