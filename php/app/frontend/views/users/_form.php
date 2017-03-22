<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View           $this
 * @var common\models\Users    $model
 * @var yii\widgets\ActiveForm $form
 */
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
                echo $form->field($model, 'username')->textInput(['autofocus' => true]);
                echo $form->field($model, 'email');
                echo $form->field($model, 'password')->passwordInput();

                //                dump($model->errors);
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                </div>

                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>
