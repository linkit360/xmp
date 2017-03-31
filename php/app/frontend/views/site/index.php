<?php
/**
 * @var $this yii\web\View
 */

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Reports and Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpanel col-md-3">
    <div class="panel-body">
        <div class="stats-title pull-left">
            <h4>LP Hits Today</h4>
        </div>

        <div class="stats-icon pull-right">
            <i class="pe-7s-shuffle fa-4x"></i>
        </div>

        <div class="m-t-xl">
            <h1 class="text-info" id="output">462</h1>
        </div>
    </div>
</div>

<script type="text/javascript">
    var ws;
    var server = "ws://127.0.0.1:3000/echo";
    function print(message) {
        console.log(message);
    }

    function start() {
        ws = new WebSocket(server);
        if (ws) {
            ws.onopen = function (evt) {
                print("OPEN");
            };

            ws.onclose = function (evt) {
                print("CLOSE");
                output.innerText = 0;
                ws = null;
                setTimeout(function () {
                    start()
                }, 5000);
            };

            ws.onmessage = function (evt) {
                var nStr = evt.data + '';
                var x = nStr.split('.');
                var x1 = x[0];
                var x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                output.innerText = x1 + x2;
            };

            ws.onerror = function (evt) {
                output.innerText = 0;
                print("ERROR: " + evt.data);
                setTimeout(function () {
                    start()
                }, 5000);
            };
        }
    }

    window.addEventListener("load", function (evt) {
        var output = document.getElementById("output");
        var input = document.getElementById("input");
        start();
    });
</script>
