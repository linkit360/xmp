<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View           $this
 * @var array                  $models
 * @var yii\widgets\ActiveForm $form
 */

$this->params['subtitle'] = 'Service Info';

$model = $models['model_service'];
$form = ActiveForm::begin();
?>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    Service Info
                </h5>
            </div>

            <div class="ibox-content">
                <?php
                echo $form->field($model, 'title')->textInput(['maxlength' => true]);
                echo $form->field($model, 'description')->textarea();
                echo $form->field($model, 'id_provider')->hiddenInput(
                    [
                        'value' => (integer)$_GET['id_provider'],
                    ]
                )->label(false);

                echo $form->field($model, 'id_service')->textInput(['maxlength' => true]);

                echo $form->field($model, 'status')->radioList(
                    [
                        1 => 'Active',
                        0 => 'Inactive',
                    ],
                    [
                        'separator' => '<br/>',
                    ]
                );

                ?>
                <div class="text-right">
                    <?php
                    echo Html::submitButton(
                        $model->isNewRecord ? 'Create' : 'Update',
                        [
                            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                            'style' => '',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    Provider Options
                </h5>
            </div>

            <div class="ibox-content">
                <?php
                echo $this->render(
                    'providers/' . (int)$_GET['id_provider'],
                    [
                        'models' => $models,
                        'form' => $form,
                    ]
                );
                ?>
            </div>
        </div>
    </div>
<?php
ActiveForm::end();
