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
<div class="content animate-panel">
    <div class="row">
        <div class="hpanel">
            <div class="panel-body">
                <h1>
                    <?= Html::encode($title) ?>
                </h1>

                <?php
                $form = ActiveForm::begin();
                ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'code')->textInput() ?>

                <?= $form->field($model, 'status')->textInput() ?>

                <?= $form->field($model, 'iso')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'priority')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
                        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>
