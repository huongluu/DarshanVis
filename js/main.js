/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
            console.log(data);
            var chart = $('#chart-container').highcharts();
            while (chart.series.length > 0) {
                chart.series[0].remove(false);
            }
            var series = data["chart"]["series"];
            var queryResult = data["queryresult"];
            for (var i = 0; i < series.length; i++) {

                var attr = series[i]["attribute"];
                var qr = queryResult[attr];
                if (qr != null) {
                    $('#chart-container').html("");
                    series[i]["data"] = [];
                    for (var j = 0; j < qr.length; j++) {
                        series[i]["data"].push([j, Number(qr[j])]);
                    }
                    console.log(series[i]);
                    chart.addSeries(series[i], false);
                } else {
                    $('#chart-container').html("<center>No result for the desired filters.</center>");
                }
            }
//                    series.forEach(function (s) {
//                        chart.addSeries(s, false);
//                    });

            chart.redraw();
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