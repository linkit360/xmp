<?php
/**
 * @var yii\web\View           $this
 * @var array                  $models
 * @var yii\widgets\ActiveForm $form
 */

# Cheese
?>
<div>
    <?php
    /*
        Cheese Mobile service settings:

        Service ID (should be unique per provider ! ) [INT input 16 ]
        Price per transaction (Currency should be visible by default based on selected country)
        Dropdown with multi select of content. (fill with dummy row)
     */

    $model = $models['model_provider'];
    echo $form->field($model, 'price')->textInput(['maxlength' => true]);
    ?>
</div>
