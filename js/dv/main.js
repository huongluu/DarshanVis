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
    $("#min_max_button").click(function(e){
      e.preventDefault();
      // alert("hey");
      var xmin = $("#min_max_button").attr("data-globalxmin");
      var xmax = $("#min_max_button").attr("data-globalxmax");
      var ymin = $("#min_max_button").attr("data-globalymin");
      var ymax = $("#min_max_button").attr("data-globalymax");
      var currentState = $("#min_max_button").attr("data-all_same");
      console.log(xmin);
      console.log(xmax);
      console.log(ymin);
      console.log(ymax);
      var charts = [];
      for (var i = 0; i < 10; i++)
      {
          var chartid = "chart-container-" + (i + 1);
          charts.push(chartid);
          // var chart = $("#" + chartid).highcharts();
          // console.log(chartid + "setting.");
          // chart.xAxis[0].setExtremes(xmin, xmax);
          // chart.yAxis[0].setExtremes(ymin, ymax);
          // console.log(chartid + "done.");
      }


      charts.map(function(item){
        var chart = $("#" + item).highcharts();
        console.log(item + "setting.");
        chart.xAxis[0].setExtremes(xmin, xmax);
        chart.yAxis[0].setExtremes(ymin, ymax);
        console.log(item + "done.");
      });

      // async.map(charts, function(item, callback){
      //   var chart = $("#" + item).highcharts();
      //   console.log(item + "setting.");
      //   chart.xAxis[0].setExtremes(xmin, xmax);
      //   chart.yAxis[0].setExtremes(ymin, ymax);
      //   console.log(item + "done.");
      //   callback();
      // }, function(err){
      //   if (err)
      //   {
      //     console.log("error.");
      //   }
      //   else
      //   {
      //     console.log("yay!");
      //   }
      // });

    });

});


function getChart(chartId, callback) {
    var filter = {
        id: chartId
    };

    $.ajax({
        url: 'chart',
        type: 'post',
        dataType: 'json',
        success: function (data) {
            callback(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        },
        data: filter
    });
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
    };
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

                        if(data.queryresult.hasOwnProperty("appname"))
                        {
                            //alert("yes, i have that property");
                             category_list=data.queryresult.appname;
                            //
                        }


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
            var date_category = false;
            if (data["chart"]["categories"]) {
                var cat = data["chart"]["categories"]["attribute"];
                var date_dt = queryResult[cat];
//                chart.xAxis[0].setCategories(date_dt);
                date_category = true;
            } else {
                console.log("categories is null");
            }
            for (var i = 0; i < series.length; i++) {
                if (!series[i]["not-in-chart"]) {
                    var attr = series[i]["attribute"];
                    var qr = queryResult[attr];
                    if (qr != null) {
                        $('#chart-container').html("");
                        series[i]["data"] = [];
                        for (var j = 0; j < qr.length; j++) {
                            var num = Number(qr[j]);
                            if (num != 0) {
                                if (date_category) {
                                    series[i]["data"].push([date_dt[j] / 1000, num]);
                                } else {
                                    series[i]["data"].push([j, num]);
                                }
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
