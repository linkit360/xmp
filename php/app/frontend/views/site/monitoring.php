<?php
/**
 * @var $this yii\web\View
 */
$this->title = 'Monitoring';

?>
<style type="text/css">
    #monIframe {
        padding: 0;
        width: 100%;
        height: 710px
    }
</style>

<div class="content animate-panel">
    <div class="row">
        <div class="hpanel">
            <div class="panel-body">
                <p>
                    Full version: <a target="_blank" href="http://monitoring.linkit360.ru/dashboard/db/mumbai">HERE</a>
                </p>

                <p>
                    user: <b>mobile</b> password: <b>m0b1l3</b>
                </p>
                <iframe id="monIframe" src="http://monitoring.linkit360.ru/dashboard/db/mumbai"></iframe>
            </div>
        </div>
    </div>
</div>
