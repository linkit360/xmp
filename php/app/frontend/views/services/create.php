<?php
/**
 * @var yii\web\View           $this
 * @var common\models\Services $model
 */

$this->title = 'Create Service';
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo $this->render(
    '_form',
    [
        'model' => $model,
    ]
);
