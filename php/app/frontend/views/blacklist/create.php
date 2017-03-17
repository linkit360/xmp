<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MsisdnBlacklist */

$this->title = 'Create Msisdn Blacklist';
$this->params['breadcrumbs'][] = ['label' => 'Msisdn Blacklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msisdn-blacklist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
