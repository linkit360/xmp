var output = [];
var ws;
var server;
var chart;

function print(message) {
    console.log(message);
}

function start() {
    ws = new WebSocket(server);
    if (ws) {
        ws.onopen = function () {
            print("Connected");
        };

        ws.onclose = function () {
            print("Disconnected");
            reset();
            ws = null;
            setTimeout(function () {
                start()
            }, 5000);
        };

        ws.onmessage = function (evt) {
            var data = JSON.parse(evt.data);
            con(data);

            // Widgets
            output[0].innerText = formatNumber(data['lp']);
            output[1].innerText = formatNumber(data['mo']);
            output[2].innerText = formatNumber(data['mos']);

            var conv = 0;
            if (data['lp'] > 0) {
                conv = (parseFloat(formatNumber(data['mos'] / data['lp']))).toFixed(2);
            }

            output[3].innerText = conv + "%";

            // Chart


        };

        ws.onerror = function (evt) {
            reset();
            print("ERROR: " + evt.data);
        };
    }
}

window.addEventListener("load", function () {
    output[0] = document.getElementById("output_lp");
    output[1] = document.getElementById("output_mo");
    output[2] = document.getElementById("output_mos");
    output[3] = document.getElementById("output_conv");
    start();

    chart = $("#hmap").highcharts();

    chart.series[0]['data'].forEach(function (element, index) {
        if (element['hc-key'] === 'ru') {
            // con(element);
            element['value'] = 777;
        }
    });


    // con(chart);
    // chart.axes[2].showAxis = false;
    // chart.redraw();

});

function formatNumber(number) {
    var nStr = number + '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function con(data) {
    console.log(data);
}

function reset() {
    output[0].innerText = 0;
    output[1].innerText = 0;
    output[2].innerText = 0;
    output[3].innerText = 0;
}
