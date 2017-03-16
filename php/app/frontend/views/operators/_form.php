<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View            $this
 * @var common\models\Operators $model
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
                echo $form->field($model, 'name')->textInput(['maxlength' => true]);
                echo $form->field($model, 'id_provider')->dropDownList($model->getProviders());
                echo $form->field($model, 'isp')->textInput(['maxlength' => true]);
                echo $form->field($model, 'msisdn_prefix')->textInput(['maxlength' => true]);
                echo $form->field($model, 'mcc')->textInput(['maxlength' => true]);
                echo $form->field($model, 'mnc')->textInput(['maxlength' => true]);
                echo $form->field($model, 'code')->textInput();
                ?>

                <div class="form-group">
                    <?php
                    echo Html::submitButton(
                        $model->isNewRecord ? 'Create' : 'Update',
                        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
                    );
                    ?>
                </div>

                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>
