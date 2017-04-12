<?php
/**
 * @var yii\web\View           $this
 * @var array                  $models
 * @var yii\widgets\ActiveForm $form
 * @var integer                $stepNow
 */

echo $this->render(
    '_steps',
    [
        'stepNow' => $stepNow,
    ]
);

echo $this->render(
    '_step_' . $stepNow,
    [
        'models' => $models,
    ]
);
