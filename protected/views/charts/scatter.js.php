<?php
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);

$series1_str = "";
$series2_str = "";
$index = 1;
foreach ($data as $d) {
//    $series1_str .= '[' . $d[$chart["series"][0]["xaxis"]] . ',' . $d[$chart["series"][0]["series1"]] . '],';
//    $series2_str .= '[' . $d[$chart["series"][0]["xaxis"]] . ',' . $d[$chart["series"][0]["series2"]] . '],';
    $series1_str .= '[' . $index . ',' . $d[$chart["series"][0]["series1"]] . '],';
    $series2_str .= '[' . $index . ',' . $d[$chart["series"][0]["series2"]] . '],';
    $index++;
}
$series1_str = rtrim($series1_str, ",");
$series2_str = rtrim($series2_str, ",");
?>
<script type="text/javascript">
    $(function() {
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
                    text: '<?php echo $chart["xAxis"]["title"] ?>'
                },
                startOnTick: true,
                endOnTick: true,
                showLastLabel: true,
                min:0 
            },
            yAxis: {
                title: {
                    text: '<?php echo $chart["yAxis"]["title"] ?>'
                },
                type: 'logarithmic'
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
                    data: [<?php echo $series1_str ?>]

                }, {
                    name: '<?php echo $chart["series"][0]["series2-name"] ?>',
                    color: 'rgba(119, 152, 191, .5)',
                    data: [<?php echo $series2_str; ?>]
                }]
        });
    });
</script>