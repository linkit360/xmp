<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                  $this
 * @var common\models\Content\Content $model
 * @var yii\widgets\ActiveForm        $form
 */
?>
<div class="col-lg-6">
    <div class="ibox">
        <div class="ibox-content">
            <?php
            $form = ActiveForm::begin();
            echo $form->field($model, 'id_category')->dropDownList(
                [null => 'Please Select'] + $model->getCategories()
            );
            echo $form->field($model, 'id_publisher')->dropDownList(
                [null => 'Please Select'] + $model->getPublishers()
            );
            echo $form->field($model, 'title')->textInput(['maxlength' => true]);
            echo $form->field($model, 'status')->radioList(
                [
                    1 => 'Active',
                    0 => 'Inactive',
                ],
                [
                    'separator' => '<br/>',
                ]
            );

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
</div>
