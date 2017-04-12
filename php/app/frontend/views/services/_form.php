<?php
/**
 * @var yii\web\View           $this
 * @var common\models\Services $model
 * @var yii\widgets\ActiveForm $form
 */

$stepNow = 1;
if (array_key_exists('step', $_GET)) {
    $stepNow = (integer)$_GET['step'];
}

echo $this->render(
    '_steps',
    [
        'stepNow' => $stepNow,
    ]
);

echo $this->render(
    '_step_' . $stepNow,
    [
    ]
);
