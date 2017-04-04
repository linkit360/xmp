<?php
/**
 * @var $this yii\web\View
 */
use frontend\assets\DashboardAsset;

DashboardAsset::register($this);

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Reports and Stats for Today';
$this->params['breadcrumbs'][] = $this->title;

$host = 'test.xmp2.linkit360.ru';
if (YII_ENV === "dev") {
    $host = "127.0.0.1";
}

$this->registerJs('server = "ws://' . $host . ':3000/echo";');
?>
<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_lp">
                0
            </h1>

            LP Hits
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_mo">
                0
            </h1>

            Total MO
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_mos">
                0
            </h1>

            Success MO
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_conv">
                0
            </h1>

            Conversion Rate
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div id="world-map" style="height: 500px;"></div>
        </div>
    </div>
</div>
