<?php

use common\models\Providers;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$this->params['subtitle'] = 'Select Provider';

$providers = Providers::find()
    ->select(
        [
            'id',
            'name',
        ]
    )
    ->where(
        [
            'id_country' => (integer)$_GET['id_country'],
        ]
    )
    ->orderBy('name')
    ->asArray()
    ->all();
?>
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5>
                Select Provider
            </h5>
        </div>

        <div class="ibox-content">
            <?php
            foreach ($providers as $provider) {
                echo Html::a(
                    $provider['name'],
                    '/services/create?step=3&id_country=' . (integer)$_GET['id_country'] . '&id_provider=' . $provider['id'],
                    [
                        'class' => 'btn btn-primary',
                    ]
                );
                echo '<br/>';
            }
            ?>
        </div>
    </div>
</div>
