/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var all_data;
$(document).ready(function () {
    $('#dv_table').DataTable({
        "lengthMenu": [[-1], ["All"]]
    });


});



function byte_formatter(c, suffix) {
    var bytes = c.value * 1000 * 1000;
    var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'EB'];
    if (bytes == 0) {
        return '0 B';
    }
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1000)));
    return Math.round(bytes / Math.pow(1000, i), 2) + ' ' + sizes[i] + suffix;
}

function byte_formatter_str_for_bytes(c, suffix) {
    c = parseInt(c);
    var bytes = c;
    var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'EB'];
    if (bytes == 0) {
        return '0 B';
    }
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1000)));
    return Math.round(bytes / Math.pow(1000, i), 2) + ' ' + sizes[i] + suffix;
}

function send() {
    var datepickerobj = $('#reportrange').data('daterangepicker');
    var filter = {
        numapp: $("#numapp-textbox").val(),
        application: $("#application-textbox").val(),
        user: $("#user-textbox").val(),
        sort_level1: $("#sort-level1 option:selected").val(),
        mode_level1: $("#mode-level1 option:selected").val(),
        sort_level2: $("#sort-level2 option:selected").val(),
        mode_level2: $("#mode-level2 option:selected").val(),
        sort_level3: $("#sort-level3 option:selected").val(),
        mode_level3: $("#mode-level3 option:selected").val(),
        start_date: datepickerobj.startDate.format('YYYY-MM-DD'),
        end_date: datepickerobj.endDate.format('YYYY-MM-DD'),
        url: window.location.href
    }

    $('#status').html('filtering..');
    $url = 'filter';
//            alert($url);
    $.ajax({
        url: $url,
        type: 'post',
        dataType: 'json',
        success: function (data) {
//                    alert("success");
            all_data = data;
            console.log(data);
            var chart = $('#chart-container').highcharts();

            if (typeof chart === 'undefined') {
                console.log("chart is null, return");
                if (typeof (make_chart_get_values) == "function") {
                    make_chart_get_values();
                }
                return;
            }
//            if (chart && isNaN(chart.series)) {
//                console.log("chart.series is null, return");
//                return;
//            }
//            if (chart && !isNaN(chart.series)) {
            while (chart.series.length > 0) {
                chart.series[0].remove(false);
            }
//            }
            var series = data["chart"]["series"];
            var queryResult = data["queryresult"];
            for (var i = 0; i < series.length; i++) {

                var attr = series[i]["attribute"];
                var qr = queryResult[attr];
                if (qr != null) {
                    $('#chart-container').html("");
                    series[i]["data"] = [];
                    for (var j = 0; j < qr.length; j++) {
                        var num = Number(qr[j]);
                        if (num != 0) {
                            series[i]["data"].push([j, num]);
                        }
                    }
                    console.log(series[i]);
//                    if (!isNaN(chart)) {
                    chart.addSeries(series[i], false);
//                    }
                } else {
                    $('#chart-container').html("<center>No result for the desired filters.</center>");
                }
            }
//                    series.forEach(function (s) {
//                        chart.addSeries(s, false);
//                    });

//            if (chart) {
            chart.redraw();
//            }
            if (typeof (make_chart_get_values) == "function") {
                make_chart_get_values();
            }
            $('#chart-container').css('visibility', 'visible');
            $('#chart-container').css('display', 'block');
            $('#status').html('&nbsp;');
//                    $('#target').html(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
            $('#status').html('error!');
        },
        data: filter
    });
}


function roundSF(num, n) {
    if (num == 0) {
        return 0;
    }

    var d = Math.ceil(Math.log10(num < 0 ? -num : num));
    var power = n - d;

    var magnitude = Math.pow(10, power);
    var shifted = Math.round(num * magnitude);
    return shifted / magnitude;
}
