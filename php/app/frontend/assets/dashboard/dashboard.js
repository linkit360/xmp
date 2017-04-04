var output = [];
var ws;
var server;
var chart;
var mapData;

function print(message) {
    console.log(message);
}

function start() {
    ws = new WebSocket(server);
    if (!ws) {
        return false;
    }

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
        // con(data);

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
        if (chart) {
            mapData = data['countries'];
            chart.series['regions'][0].setValues(data['countries']);
        }
    };

    ws.onerror = function (evt) {
        reset();
        print("ERROR: " + evt.data);
    };
}

window.addEventListener("load", function () {
    // chart = $("#hmap").highcharts();
    output[0] = document.getElementById("output_lp");
    output[1] = document.getElementById("output_mo");
    output[2] = document.getElementById("output_mos");
    output[3] = document.getElementById("output_conv");
    start();

    chart = new jvm.Map({
        map: 'world_mill_en',
        container: $('#world-map'),
        backgroundColor: "transparent",
        regionStyle: {
            initial: {
                fill: '#e4e4e4',
                "fill-opacity": 0.9,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 0
            }
        },
        series: {
            regions: [{
                values: {},
                scale: ["#1ab394", "#22d6b1"],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionTipShow: function (e, el, code) {
            if (mapData) {
                if (typeof mapData[code] !== "undefined") {
                    el.html(el.html() + ' ' + mapData[code]);
                } else {
                    el.html(el.html() + ' 0');
                }
            }
        },
        onRegionClick: function (e, code) {
            return showPopup(code);
        }
    });
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
    output[3].innerText = "0%";
}

function showPopup(code) {
    // con(code);
    $.getJSON("/site/country?iso=" + code, function (data) {
        if (data) {
            // con(data);
            $('#modal_output_name').html(data['name']);
            $('#modal_output_lp').html(data['lp_hits']);
            $('#modal_output_mo').html(data['mo']);
            $('#modal_output_mos').html(data['mo_success']);
            var conv = 0;
            if (data['lp_hits'] > 0) {
                conv = (parseFloat(formatNumber(data['mo_success'] / data['lp_hits']))).toFixed(2);
            }
            $('#modal_output_conv').html(conv + "%");
        }

        $('#myModal').modal('show');
    });
    return true;
}
