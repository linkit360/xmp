<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Lp */

$this->title = 'Create Lp';
$this->params['breadcrumbs'][] = ['label' => 'Lps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
