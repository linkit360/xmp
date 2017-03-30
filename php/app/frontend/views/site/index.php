<?php
/**
 * @var $this yii\web\View
 */

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Reports and Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpanel col-lg-12">
    <div class="panel-body">
        Hello (:
    </div>
</div>

<div class="hpanel col-lg-12">
    <div class="panel-body">
        <div id="output">0</div>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener("load", function (evt) {
        var output = document.getElementById("output");
        var input = document.getElementById("input");
        var ws = new WebSocket("ws://127.0.0.1:3000/echo");
        ws.onopen = function (evt) {
            print("OPEN");
        };

        ws.onclose = function (evt) {
            print("CLOSE");
            output.innerText = 0;
            ws = null;
        };

        ws.onmessage = function (evt) {
            output.innerText = evt.data;
        };

        ws.onerror = function (evt) {
            output.innerText = 0;
            print("ERROR: " + evt.data);
        };

        var print = function (message) {
            console.log(message);
        };
    });
</script>
