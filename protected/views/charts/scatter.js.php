<?php
$axisTitles = array(
    "nprocs" => "Number of Processes",
    "total_bytes" => "Amount of Data Read/Written",
    "thruput" => "I/O Throughput",
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
        $("#sort-button").hide();
        $("#toggle-percentage").hide();
        $("#chart-config").toggle();

        $("#chart-config-sel-x").val("nprocs");
        $("#chart-config-sel-y").val("total_bytes");
        $("#chart-config-sel-x-scale").val("logarithmic");
        $("#chart-config-sel-y-scale").val("logarithmic");

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
        "thruput": "I/O Throughput",
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

    function date_formatter(string) {
      //2015-09-03 13:20:46
      var strArr = string.split(" ");
      var yymmdd = strArr[0]; //gives us 2015-09-03
      var indiv = yymmdd.split("-");
      // indiv[0] is year
      var year = parseInt(indiv[0]);
      // indiv[1] is month, BUT ZERO BASED so subtract one
      var month = parseInt(indiv[1]) - 1;
      // indiv[2] is day
      var day = parseInt(indiv[2]);

      // Date.UTC('year', 'month', 'day')
      return parseInt(Date.UTC(year, month, day));
    }


    make_chart = function (xaxis, yaxis, x_scale, y_scale) {
        console.log("all_data");
        console.log(all_data);
        var series_obj = all_data["queryresult"];
        var str_s1 = series_obj[xaxis];
        var str_s2 = series_obj[yaxis];
        var ret = "";
        var ret_obj = [];

        if (xaxis == "start_time")
        {
          x_scale = 'datetime';
        }
        if (yaxis == "start_time")
        {
          y_scale = 'datetime';
        }

        for (var i = 0; i < str_s1.length; i++)
        {
            if (str_s1[i].length != 0 && str_s2[i].length != 0)
            {
                if (xaxis != "start_time")
                {
                  var x = parseInt(str_s1[i]);
                }
                else
                {
                  var x = date_formatter(str_s1[i]);
                }
                if (yaxis != "start_time")
                {
                  var y = parseInt(str_s2[i]);
                }
                else {
                  var y = date_formatter(str_s2[i]);
                }

                if (x == 0 || y == 0)
                {
                    console.log('found zero');
                    console.log(x + ", " + y);
                    continue;
                }

                ret_obj.push([x, y]);
            }
        }

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
            legend: {
                enabled: false
            },
            xAxis: {
                title: {
                    enabled: true,
                    text: axisTitles[xaxis],
                    style: {
                      fontSize: '20px'
                    }
                },
                type: x_scale,
                labels: {
                    formatter: function () {
                      var str = "";
                      if (xaxis == "thruput")
                      {
                        str += byte_formatter_str_for_bytes(this.value, "/s");
                      }
                      else if (xaxis == "total_bytes")
                      {
                        str += byte_formatter_str_for_bytes(this.value, "");
                      }
                      else if (xaxis == "nprocs")
                      {
                        str += num_procs_formatter_str(this.value, "");
                      }
                      else if (xaxis == "start_time")
                      {
                        str += Highcharts.dateFormat('%b-%d-%y', this.value);
                      }
                      else {
                        str += this.value;
                      }
                      return str;
                    },
                    style: {
                      fontSize: '15px'
                    }
                }
            },
            yAxis: {
                title: {
                    text: axisTitles[yaxis],
                    style: {
                      fontSize: '20px'
                    }
                },
                type: y_scale,
                labels: {
                    formatter: function () {
                      var str = "";
                      if (yaxis == "thruput")
                      {
                        str += byte_formatter_str_for_bytes(this.value, "/s");
                      }
                      else if (yaxis == "total_bytes")
                      {
                        str += byte_formatter_str_for_bytes(this.value, "");
                      }
                      else if (yaxis == "nprocs")
                      {
                        str += num_procs_formatter_str(this.value, "");
                      }
                      else if (yaxis == "start_time")
                      {
                        str += Highcharts.dateFormat('%b-%d-%y', this.value);
                      }
                      else {
                        str += this.value;
                      }
                      return str;
                    },
                    style: {
                      fontSize: '15px'
                    }
                }
            },
            // plotOptions: {
            //     scatter: {
            //         marker: {
            //             radius: 5,
            //             states: {
            //                 hover: {
            //                     enabled: true,
            //                     lineColor: 'rgb(100,100,100)'
            //                 }
            //             }
            //         },
            //         states: {
            //             hover: {
            //                 marker: {
            //                     enabled: false
            //                 }
            //             }
            //         }
            //     }
            // },
            exporting: {
                buttons: {
                    contextButton: {
                        symbol: "url(../../img/printer2.png)"
                        }
                }
            },
            tooltip: {
                formatter: function() {
                  var str = "";
                  if (xaxis == "thruput")
                  {
                    str += "X= " + byte_formatter_str_for_bytes(this.x, "/s");
                  }
                  else if (xaxis == "total_bytes")
                  {
                    str += "X= " + byte_formatter_str_for_bytes(this.x, "");
                  }
                  else if (xaxis == "nprocs")
                  {
                    str += "X= " + num_procs_formatter_str(this.x, "");
                  }
                  else if (xaxis == "start_time")
                  {
                    str += "X= " + Highcharts.dateFormat('%b-%d-%y', this.x);
                  }
                  else {
                    str += "X= " + this.x;
                  }
                  if (yaxis == "thruput") {
                    str += ", Y= " + byte_formatter_str_for_bytes(this.y, "/s");
                  }
                  else if(yaxis == "total_bytes")
                  {
                    str += ", Y= " + byte_formatter_str_for_bytes(this.y, "");
                  }
                  else if (yaxis == "nprocs")
                  {
                    str += ", Y= " + num_procs_formatter_str(this.y, "");
                  }
                  else if (yaxis == "start_time")
                  {
                    str += ", Y=" + Highcharts.dateFormat('%b-%d-%y', this.y);
                  }
                  else {
                    str += ", Y= " + this.y;
                  }
                  return str;
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
        } else if (yaxis != "start_time") {
            options.yAxis.min = 1;

        }
        if (x_scale == "linear") {
            options.xAxis.min = 0;
        } else if (xaxis != "start_time") {
            options.xAxis.min = 1;
        }

        $("#chart-container").highcharts(options);

        // chart.redraw();
    }
</script>
