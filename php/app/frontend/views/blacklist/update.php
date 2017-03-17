<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MsisdnBlacklist */

$this->title = 'Update Msisdn Blacklist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Msisdn Blacklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="msisdn-blacklist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
