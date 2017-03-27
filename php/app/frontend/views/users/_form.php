<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View           $this
 * @var common\models\Users    $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="content animate-panel row">
    <div class="hpanel col-lg-6">
        <div class="panel-body">
            <h2>
                <?= Html::encode($this->title) ?>
            </h2>

            <?php
            $form = ActiveForm::begin();
            echo $form->field($model, 'username')->textInput(['autofocus' => true]);
            echo $form->field($model, 'email');
            echo $form->field($model, 'password')->passwordInput();
            echo Html::submitButton('Create', ['class' => 'btn btn-success']);
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
