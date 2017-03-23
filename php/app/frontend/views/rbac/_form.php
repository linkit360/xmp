<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var \frontend\models\RbacForm $model
 * @var yii\widgets\ActiveForm    $form
 * @var string                    $title
 */
?>
<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-6">
            <div class="hpanel">
                <div class="panel-body">
                    <h1>
                        <?= Html::encode($title) ?>
                    </h1>

                    <?php
                    $form = ActiveForm::begin();
                    echo $form->field($model, 'name')->textInput(['maxlength' => true]);
                    echo $form->field($model, 'description')->textarea(['rows' => 6]);
                    echo $form->field($model, 'permissions')->checkboxList(
                        $model->getPermissionsAll(),
                        [
                            'separator' => '<br/>',
                        ]
                    );
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
</div>
