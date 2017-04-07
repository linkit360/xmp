var output = [];
var ws;
var server;
var chart;
// var mapData;

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
            var series = [];
            $.each(data['countries'], function (index, value) {
                series.push([
                    iso.countries[index]['ioc'],
                    value
                ]);
            });


            var onlyValues = series.map(function (obj) {
                return obj[1];
            });

            var minValue = Math.min.apply(null, onlyValues),
                maxValue = Math.max.apply(null, onlyValues);

            var paletteScale = d3.scale.linear()
                .domain([minValue, maxValue])
                .range(["#EFEFFF", "#0d80ca"]);

            var dataset = {};
            series.forEach(function (item) {
                var iso = item[0],
                    value = item[1];
                dataset[iso] = {numberOfThings: value, fillColor: paletteScale(value)};
            });

            chart.updateChoropleth(dataset);
        }
    };

    ws.onerror = function (evt) {
        reset();
        print("ERROR: " + evt.data);
    };
}

window.addEventListener("load", function () {
    output[0] = document.getElementById("output_lp");
    output[1] = document.getElementById("output_mo");
    output[2] = document.getElementById("output_mos");
    output[3] = document.getElementById("output_conv");
    start();

    chart = new Datamap({
        element: document.getElementById('world-map'),
        projection: 'mercator',
        fills: {defaultFill: '#F5F5F5'},
        geographyConfig: {
            borderColor: '#DEDEDE',
            highlightBorderWidth: 2,
            highlightFillColor: function (geo) {
                return geo['fillColor'] || '#F5F5F5';
            },
            highlightBorderColor: '#B7B7B7',
            popupTemplate: function (geo, data) {
                var text = '<div class="hoverinfo">' +
                    '<strong>' + geo.properties.name + '</strong>';

                if (data) {
                    text += '<br>LP Hits: <strong>' + data.numberOfThings + '</strong>';
                }

                text += '</div>';
                return text;
            }
        },
        done: function (datamap) {
            datamap.svg.selectAll('.datamaps-subunit').on('click', function (geography) {
                showPopup(iso.findCountryByCode(geography.id)['alpha2']);
            });
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

function dump(data) {
    console.log(data);
}

function reset() {
    output[0].innerText = 0;
    output[1].innerText = 0;
    output[2].innerText = 0;
    output[3].innerText = "0%";
    map.updateChoropleth(
        null,
        {
            reset: true
        }
    );
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
