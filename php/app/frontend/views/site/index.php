<?php
/**
 * @var $this yii\web\View
 */
use frontend\assets\DashboardAsset;

DashboardAsset::register($this);

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Reports and Stats for Today';
$this->params['breadcrumbs'][] = $this->title;

$host = 'ws://' . $_SERVER['HTTP_HOST'];
//if (YII_ENV === 'dev') {
//    $host = 'ws://localhost';
//}

$this->registerJs('server = "' . $host . ':3000/echo";');
?>
<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_lp">
                0
            </h1>

            LP Hits
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_mo">
                0
            </h1>

            Total MO
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_mos">
                0
            </h1>

            Success MO
        </div>
    </div>
</div>

<div class="col-lg-3">
    <div class="ibox">
        <div class="ibox-content">
            <h1 class="no-margins" id="output_conv">
                0%
            </h1>

            Conversion Rate
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-content">
            <div id="world-map" style="height: 500px;"></div>
        </div>
    </div>
</div>

<?php
# 'View Country' Modal window
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header text-center">
                <h4 class="modal-title" id="modal_output_name">
                    Country
                </h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h1 class="no-margins" id="modal_output_lp">
                                    0
                                </h1>

                                LP Hits
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h1 class="no-margins" id="modal_output_mo">
                                    0
                                </h1>

                                Total MO
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h1 class="no-margins" id="modal_output_mos">
                                    0
                                </h1>

                                Success MO
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h1 class="no-margins" id="modal_output_conv">
                                    0%
                                </h1>

                                Conversion Rate
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
