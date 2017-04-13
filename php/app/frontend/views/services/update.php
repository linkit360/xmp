<?php
/**
 * @var yii\web\View $this
 * @var array        $models
 * @var integer      $stepNow
 */

$this->title = 'Update Services: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
echo $this->render(
    '_form',
    [
        'models' => $models,
        'stepNow' => $stepNow,
    ]
);
