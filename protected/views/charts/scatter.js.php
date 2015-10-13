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
  $x_options_list .= "<option value=" . $str . ">" . $str . "<option>";
}
foreach ($y_options as $str)
{
  $y_options_list .= "<option value=" . $str . ">" . $str . "<option>";
}

$series1_str = rtrim($series1_str, ",");
$series2_str = rtrim($series2_str, ",");
$series_str = rtrim($series_str, ",");
//$series3_str = rtrim($series3_str, ",");
//$series4_str = rtrim($series4_str, ",");
?>
<script type="text/javascript">
    $(function () {
        $('#chart-container').highcharts({
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
                    text: '<?php echo $chart["series"][0]["series2-name"] ?>'
                },
                type: '<?php echo $chart["xAxis"]["type"] ?>',
                startOnTick: true,
                endOnTick: true,
                showLastLabel: true,
                min: 0
            },
            yAxis: {
                title: {
                    text: '<?php echo $chart["series"][0]["series1-name"] ?>'
                },
                type: '<?php echo $chart["xAxis"]["type"] ?>',
                min:0
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 70,
                y: 50,
                floating: true,
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
                    name: '<?php echo $chart["series"][0]["series1-name"] ?>',
                    color: 'rgba(223, 83, 83, .5)',
                    data: [<?php echo $series_str ?>]
                }
            ]
        });

        $("#chart-config-sel-x").html('<?php echo $x_options_list ?>');
        $("#chart-config-sel-y").html('<?php echo $y_options_list ?>');
        $("#chart-config").toggle();

        console.log('<?php echo $y_options[0] ?>');
    });
</script>
