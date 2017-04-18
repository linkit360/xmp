<?php

use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                $this
 * @var frontend\models\ContentForm $model
 * @var yii\widgets\ActiveForm      $form
 */
?>
<div class="col-lg-6">
    <div class="ibox">
        <div class="ibox-content">
            <?php
            $form = ActiveForm::begin(
                [
                    'options' =>
                        [
                            'enctype' => 'multipart/form-data',
                        ],
                ]
            );
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

            echo $form->field($model, 'blacklist_tmp')->widget(
                Select2::classname(),
                [
                    'data' => $model->getCountries(),
                    'options' => [
                        'placeholder' => 'Select ...',
                        'multiple' => true,
                    ],
                    'pluginOptions' => [
//                        'allowClear' => true,
                        'escapeMarkup' => new JsExpression("function(m) { return m; }"),
                    ],
                ]
            );

            echo FileInput::widget(
                [
                    'name' => 'file',
                    'options' => [
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/content/file-upload']),
                        'uploadExtraData' => [
                            'album_id' => 20,
                            'cat_id' => 'Nature',
                        ],
                        'maxFileCount' => 1,
                    ],
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
