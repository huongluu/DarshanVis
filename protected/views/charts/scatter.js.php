<?php
// include_once 'utils2.php';

$data = Jobs::execSQLQuery($chart["series"][0]["query"]);

$series1_str = "";
$series2_str = "";
$series_str = "";

//$series3_str = "";
//$series4_str = "";
$index = 1;
foreach ($data as $d) {
//    $series1_str .= '[' . $d[$chart["series"][0]["xaxis"]] . ',' . $d[$chart["series"][0]["series1"]] . '],';
//    $series2_str .= '[' . $d[$chart["series"][0]["xaxis"]] . ',' . $d[$chart["series"][0]["series2"]] . '],';
    $series1_str .= '[' . $index . ',' . $d[$chart["series"][0]["series1"]] . '],';
    $series2_str .= '[' . $index . ',' . $d[$chart["series"][0]["series2"]] . '],';
    $series_str .= '[' . $d[$chart["series"][0]["series1"]] . ',' . $d[$chart["series"][0]["series2"]] . '],';
//    $series3_str .= '[' . $index . ',' . $d[$chart["series"][0]["series3"]] . '],';
//    $series4_str .= '[' . $index . ',' . $d[$chart["series"][0]["series4"]] . '],';
    $index++;
}

$x_options = $chart["yAxis"]["options"];
$y_options = $chart["yAxis"]["options"];

$x_options_list = "";
$y_options_list = "";

foreach ($x_options as $str)
{
  $x_options_list .= "<option value=" . $str . ">" . $str . "</option>";
}
foreach ($y_options as $str)
{
  $y_options_list .= "<option value=" . $str . ">" . $str . "</option>";
}

// create json array with each option and its data set


$ret = array();

foreach($x_options as $str)
{
  $series = "";
  foreach ($data as $d)
  {
    $series .= $d[$str] . ',';
    // $series = rtrim($series, ",");
  }
  $ret[$str] = $series;
}

$json_str = json_encode($ret);


$series1_str = rtrim($series1_str, ",");
$series2_str = rtrim($series2_str, ",");
$series_str = rtrim($series_str, ",");
//$series3_str = rtrim($series3_str, ",");
//$series4_str = rtrim($series4_str, ",");
?>
<script type="text/javascript">
    $(function () {
      var axisTitles = {
        "nprocs":"Number of Processes",
        "total_bytes":"Amount of Data read/written",
        "agg_perf_MB":"I/O Throughput"
      };

        // $('#chart-container').highcharts({
        //     chart: {
        //         type: 'scatter',
        //         zoomType: 'xy'
        //     },
        //     title: {
        //         text: '<?php echo $chart["title"] ?>'
        //     },
        //     subtitle: {
        //         text: '<?php echo $chart["subtitle"] ?>'
        //     },
        //     xAxis: {
        //         title: {
        //             enabled: true,
        //             text: '<?php echo $chart["series"][0]["series2-name"] ?>'
        //         },
        //         type: '<?php echo $chart["xAxis"]["type"] ?>',
        //         startOnTick: true,
        //         endOnTick: true,
        //         showLastLabel: true,
        //         min: 0
        //     },
        //     yAxis: {
        //         title: {
        //             text: '<?php echo $chart["series"][0]["series1-name"] ?>'
        //         },
        //         type: '<?php echo $chart["xAxis"]["type"] ?>',
        //         min:0
        //     },
        //     legend: {
        //         layout: 'vertical',
        //         align: 'left',
        //         verticalAlign: 'top',
        //         x: 0,
        //         y: 0,
        //         // floating: true,
        //         backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
        //         borderWidth: 1
        //     },
        //     plotOptions: {
        //         scatter: {
        //             marker: {
        //                 radius: 5,
        //                 states: {
        //                     hover: {
        //                         enabled: true,
        //                         lineColor: 'rgb(100,100,100)'
        //                     }
        //                 }
        //             },
        //             states: {
        //                 hover: {
        //                     marker: {
        //                         enabled: false
        //                     }
        //                 }
        //             },
        //             tooltip: {
        //                 headerFormat: '<b>{series.name}</b><br>',
        //                 pointFormat: 'App: {point.x}, {point.y} Bytes'
        //             }
        //         }
        //     },
        //     series: [{
        //             name: '<?php echo $chart["series"][0]["series1-name"] ?>',
        //             color: 'rgba(223, 83, 83, .5)',
        //             data: [<?php echo $series_str ?>]
        //         }
        //     ]
        // });

        $("#chart-config-sel-x").html('<?php echo $x_options_list ?>');
        $("#chart-config-sel-y").html('<?php echo $y_options_list ?>');
        $("#chart-config").toggle();

        $("#chart-config-sel-x").val("nprocs");
        $("#chart-config-sel-y").val("total_bytes");

        // $("#chart-config-sel-x").change(function(){
        //   alert($("#chart-config-sel-x").val());
        //   make_chart($("#chart-config-sel-x").val(), $("#chart-config-sel-y").val())
        // });

        $("#chart-config-button").click(function(){
          //  console.log(returnData($("#chart-config-sel-x").val(), $("#chart-config-sel-y").val(), <?php echo $json_str?>));
          //  make_chart($("#chart-config-sel-x").val(), $("#chart-config-sel-y").val())
          var x = $("#chart-config-sel-x").val();
          var y = $("#chart-config-sel-y").val();
          var x_scale = $("#chart-config-sel-x-scale").val();
          var y_scale = $("#chart-config-sel-y-scale").val();

          make_chart(x, y, x_scale, y_scale);
        });

        $(".chart-config-selector").change(function(){
          var x = $("#chart-config-sel-x").val();
          var y = $("#chart-config-sel-y").val();
          var x_scale = $("#chart-config-sel-x-scale").val();
          var y_scale = $("#chart-config-sel-y-scale").val();

          make_chart(x, y, x_scale, y_scale);
        });

        // console.log('<?php echo $y_options_list ?>');
        // console.log('<?php echo $json_str ?>');


        returnData = function(s1, s2, obj)
        {
          // console.log(json);
          // var obj = $.parseJSON(json);
          // console.log(obj);
          console.log("entered return data");
          var str_s1 = obj[s1].split(',');
          var str_s2 = obj[s2].split(',');

          var ret = "";

          for (var i=0; i<str_s1.length; i++)
          {
            if (str_s1[i].length != 0 && str_s2[i].length != 0)
            {
              ret += "[" + parseInt(str_s1[i]) + ',' + parseInt(str_s2[i]) + "],";
            }
          }
          ret = ret.replace(/,\s*$/, "");

          return ret;
        }

        // make_chart1 = function(xaxis, yaxis)
        // {
        //   var chart = $("#chart-container").highcharts();
        //   var series_name ="";
        //   // var str1 = "[" + returnData(xaxis, yaxis, <?php echo $json_str?>) + "]";
        //   // var str2 = returnData(xaxis, yaxis, <?php echo $json_str?>);
        //   // console.log("TYPE: \n"+chart.series[0].type);
        //   // console.log("XAXIS:\n"+chart.series[0].xAxis);
        //   // console.log("YAXIS:\n"+chart.series[0].yAxis);
        //   var obj = <?php echo $json_str?>;
        //
        //   var str_s1 = obj[xaxis].split(',');
        //   var str_s2 = obj[yaxis].split(',');
        //
        //   // chart.series[0].data.length = 0;
        //   var ret = "";
        //   var ret_obj = [];
        //
        //   for (var i=0; i<str_s1.length; i++)
        //   {
        //     if (str_s1[i].length != 0 && str_s2[i].length != 0)
        //     {
        //       ret += "[" + parseInt(str_s1[i]) + ',' + parseInt(str_s2[i]) + "],";
        //       // console.log("X: " + str_s1[i]);
        //       // console.log("Y: " + str_s2[i]);
        //       ret_obj.push([parseInt(str_s1[i]), parseInt(str_s2[i])]);
        //       // chart.series[0].addPoint([str_s1[i], str_s2[i]], true, true);
        //     }
        //   }
        //   ret = ret.replace(/,\s*$/, "");
        //
        //   // console.log("DATA: \n"+ret);
        //   // console.log(chart.series[0].data);
        //   console.log("RET OBJ:\n");
        //   console.log(ret_obj);
        //   chart.xAxis[0].setTitle(xaxis);
        //   chart.yAxis[0].setTitle(yaxis);
        //   // console.log(chart);
        //   // chart.series[0].remove();
        //   // chart.series[0].data = [];
        //   // chart.series[0].setData(ret);
        //   chart.series[0].data.length = 0;
        //   chart.series[0].setData(ret_obj, true);
        //   // chart.series[0].data.push(ret_obj);
        //   console.log("\n\t\tNEW\n");
        //   console.log(chart.series[0].data);
        //   chart.redraw();
        // }

        make_chart = function(xaxis, yaxis, x_scale, y_scale){
          var chart = $("#chart-container").highcharts();
          // var str1 = "[" + returnData(xaxis, yaxis, <?php echo $json_str?>) + "]";
          // var str2 = returnData(xaxis, yaxis, <?php echo $json_str?>);
          // console.log("TYPE: \n"+chart.series[0].type);
          // console.log("XAXIS:\n"+chart.series[0].xAxis);
          // console.log("YAXIS:\n"+chart.series[0].yAxis);
          var obj = <?php echo $json_str?>;

          var str_s1 = obj[xaxis].split(',');
          var str_s2 = obj[yaxis].split(',');
          // chart.series[0].data.length = 0;
          var ret = "";
          var ret_obj = [];

          for (var i=0; i<str_s1.length; i++)
          {
            if (str_s1[i].length != 0 && str_s2[i].length != 0)
            {
              ret += "[" + parseInt(str_s1[i]) + ',' + parseInt(str_s2[i]) + "],";
              // console.log("X: " + str_s1[i]);
              // console.log("Y: " + str_s2[i]);
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
                  type: x_scale,
                  startOnTick: true,
                  endOnTick: true,
                  showLastLabel: true
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
                      },
                      tooltip: {
                          headerFormat: '<b>{series.name}</b><br>',
                          pointFormat: 'App: {point.x}, {point.y} Bytes'
                      }
                  }
              },
              series: [{
                      name: xaxis + ' vs. ' + yaxis,
                      color: 'rgba(223, 83, 83, .5)',
                      data: ret_obj
                      // [returnData(xaxis, yaxis, <?php echo $json_str?>)]
                  }
              ]
          };

          if (y_scale == "linear")
          {
            options.yAxis.min = 0;
          }
          if (x_scale == "linear")
          {
            options.xAxis.min = 0;
          }

          $("#chart-container").highcharts(options);

          // chart.redraw();
        }

        make_chart("nprocs", "total_bytes", "linear", "linear");
    });
</script>
