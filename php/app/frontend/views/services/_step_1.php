<?php

use common\models\Countries;
use common\models\Providers;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$this->params['subtitle'] = 'Select Country';

$providers = Providers::find()
    ->select('id_country')
    ->groupBy('id_country')
    ->asArray()
    ->column();


$countries = Countries::find()
    ->select(
        [
            'id',
            'name',
        ]
    )
    ->where(
        [
            'id' => $providers,
        ]
    )
    ->orderBy('name')
    ->all();
?>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Select Country
            </h5>
        </div>

        <div class="ibox-content">
            <?php
            foreach ($countries as $country) {
                echo Html::a(
                    $country['name'],
                    '/services/create?step=2&id_country=' . $country['id'],
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
