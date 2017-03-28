<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var common\models\Countries $model
 * @var yii\widgets\ActiveForm  $form
 * @var string                  $title
 */
?>
<div class="hpanel col-lg-6">
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin();
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        echo $form->field($model, 'code')->textInput();
        echo $form->field($model, 'status')->textInput();
        echo $form->field($model, 'iso')->textInput(['maxlength' => true]);
        echo $form->field($model, 'priority')->textInput();
        echo Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update',
            [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            ]
        );
        ActiveForm::end();
        ?>
    </div>
</div>
