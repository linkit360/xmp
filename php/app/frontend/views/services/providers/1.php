<?php
/**
 * @var yii\web\View           $this
 * @var array                  $models
 * @var yii\widgets\ActiveForm $form
 */

# Cheese
/*
    Cheese Mobile service settings:

    Price per transaction (Currency should be visible by default based on selected country)
    Dropdown with multi select of content. (fill with dummy row)
 */

$country = \common\models\Countries::findOne((integer)$_GET['id_country']);
$model = $models['model_provider'];
echo $form->field($model, 'price')
    ->textInput(['maxlength' => true])
    ->hint($country && $country->currency != '' ? 'Currency: ' . $country->currency : '');
