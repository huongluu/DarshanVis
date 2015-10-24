<?php
$axisTitles = array(
    "nprocs" => "Number of Processes",
    "total_bytes" => "Amount of Data Read/Written",
    "agg_perf_MB" => "I/O Throughput",
    "start_time" => "Submission Date",
    "uid" => "User ID"
);

$x_options = $chart["yAxis"]["options"];
$y_options = $chart["yAxis"]["options"];

$x_options_list = "";
$y_options_list = "";

foreach ($x_options as $str) {
    $x_options_list .= "<option value=" . $str . ">" . $axisTitles[$str] . "</option>";
}
foreach ($y_options as $str) {
    $y_options_list .= "<option value=" . $str . ">" . $axisTitles[$str] . "</option>";
}

// create json array with each option and its data set
?>
<script type="text/javascript">
    $(function () {
        send();

        $("#chart-config-sel-x").html('<?php echo $x_options_list ?>');
        $("#chart-config-sel-y").html('<?php echo $y_options_list ?>');
        $("#chart-config").toggle();

        $("#chart-config-sel-x").val("nprocs");
        $("#chart-config-sel-y").val("total_bytes");

        // $("#chart-config-sel-x").change(function(){
        //   alert($("#chart-config-sel-x").val());
        //   make_chart($("#chart-config-sel-x").val(), $("#chart-config-sel-y").val())
        // });

        $("#chart-config-button").click(function () {
            var x = $("#chart-config-sel-x").val();
            var y = $("#chart-config-sel-y").val();
            var x_scale = $("#chart-config-sel-x-scale").val();
            var y_scale = $("#chart-config-sel-y-scale").val();

            make_chart(x, y, x_scale, y_scale);
        });

        $(".chart-config-selector").change(function () {
            make_chart_get_values();
        });

//        make_chart("nprocs", "total_bytes", "linear", "linear");
    });


    var axisTitles = {
        "nprocs": "Number of Processes",
        "total_bytes": "Amount of Data Read/Written",
        "agg_perf_MB": "I/O Throughput",
        "start_time": "Start Time",
        "uid": "User ID"
    };

    function make_chart_get_values() {
        var x = $("#chart-config-sel-x").val();
        var y = $("#chart-config-sel-y").val();
        var x_scale = $("#chart-config-sel-x-scale").val();
        var y_scale = $("#chart-config-sel-y-scale").val();

        make_chart(x, y, x_scale, y_scale);
    }


    make_chart = function (xaxis, yaxis, x_scale, y_scale) {
//            var chart = $("#chart-container").highcharts();

        console.log("all_data");
//            console.log(all_data);
//            if (isNaN(all_data)) {
//                console.log("all_data is null, return");
//                return;
//            }
        console.log(all_data);
        var series_obj = all_data["queryresult"];
        var str_s1 = series_obj[xaxis];
        var str_s2 = series_obj[yaxis];
//           
//           var str_s1 = obj[xaxis].split(',');
//            var str_s2 = obj[yaxis].split(',');
        // chart.series[0].data.length = 0;
        var ret = "";
        var ret_obj = [];

        for (var i = 0; i < str_s1.length; i++)
        {
            if (str_s1[i].length != 0 && str_s2[i].length != 0)
            {
//                ret += "[" + parseInt(str_s1[i]) + ',' + parseInt(str_s2[i]) + "],";
                // console.log("X: " + str_s1[i]);
                // console.log("Y: " + str_s2[i]);
                var x = parseInt(str_s1[i]);
                var y = parseInt(str_s2[i]);

                if (x == 0 || y == 0)
                {
                    console.log('found zero');
                    console.log(x + ", " + y);
                    continue;
                }
                ret_obj.push([parseInt(str_s1[i]), parseInt(str_s2[i])]);
                // chart.series[0].addPoint([str_s1[i], str_s2[i]], true, true);
            }
        }
        // console.log("RET OBJ:\n");
        // console.log(ret_obj);

        var options = {
            chart: {
                type: 'scatter',
                zoomType: 'xy'
            },
            title: {
                text: '<?php echo $chart["title"] ?>'
            },
            subtitle: {
                text: '<?php echo $chart["subtitle"] ?>'
            },
            xAxis: {
                title: {
                    enabled: true,
                    text: axisTitles[xaxis]
                },
                type: x_scale
            },
            yAxis: {
                title: {
                    text: axisTitles[yaxis]
                },
                type: y_scale
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 0,
                y: 0,
                // floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                borderWidth: 1
            },
            plotOptions: {
                scatter: {
                    marker: {
                        radius: 5,
                        states: {
                            hover: {
                                enabled: true,
                                lineColor: 'rgb(100,100,100)'
                            }
                        }
                    },
                    states: {
                        hover: {
                            marker: {
                                enabled: false
                            }
                        }
                    }
                }
            },
            series: [{
                    name: xaxis + ' vs. ' + yaxis,
                    color: 'rgba(223, 83, 83, .5)',
                    data: ret_obj
                }
            ]
        };

        if (y_scale == "linear") {
            options.yAxis.min = 0;
        } else {
            options.yAxis.min = 1;

        }
        if (x_scale == "linear") {
            options.xAxis.min = 0;
        } else {
            options.xAxis.min = 1;

        }

        $("#chart-container").highcharts(options);

        // chart.redraw();
    }
</script>
