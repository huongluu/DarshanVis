<?php

// Create K array for K series for K apps: for now: K=15, K should be dynamically set
$data_series = array();
for ($i = 0; $i < 15; $i++){
    $data_series[$i] = array();
}

// Get Data from MySQL and create data series for chart
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);
           // "series1": "total_bytes",
           // "series2": "nprocs",
           // "series3": "agg_perf_MB",
           // "series4": "appname",
           // "series5": "rank",

$series1_str = "";
$series2_str = "";
$series_str = "";
$xseries_str = "";
$yseries_str = "";

$index = 1;
foreach ($data as $d) {
    $id = $d[$chart["series"][0]["series5"]] ;
    $xseries_str = $d[$chart["series"][0]["series1"]] ;
    $yseries_str = $d[$chart["series"][0]["series2"]] ;
    $series_str .= '['.$xseries_str.', '.$yseries_str.']' . ',';  //format "[x,y]," - Do we need the last ',' ??
    $data_series[$id][] = $series_str;
    
    //$xseries_str = $d[$chart["series"][0]["series1"]] ;
    //$yseries_str = $d[$chart["series"][0]["series2"]] ;
    //$series_str .= '['.$xseries_str.', '.$yseries_str.']' . ',';  //format "[x,y]," - Do we need the last ',' ??
    //$data_series[$id][] = $series_str;
    
    //$series1_str .= '[' . $index . ',' . $d[$chart["series"][0]["series1"]] . '],';
    //$series2_str .= '[' . $index . ',' . $d[$chart["series"][0]["series2"]] . '],';
    $index++;
}
$series1_str = rtrim($series1_str, ",");
$series2_str = rtrim($series2_str, ",");
?>
<script type="text/javascript">
    $(function() {
        $('#chart-container').append("<div class='row'>" +
                "<div id = 'c11' class = 'col-md-4' > </div>" +
                "<div id = 'c12' class = 'col-md-4' > </div>" +
                "<div id = 'c13' class = 'col-md-4' > </div>" +
                "</div>" +
                "<div class = 'row' >" +
                "<div id = 'c21' class = 'col-md-4' > </div>" +
                "<div id = 'c22' class = 'col-md-4' > </div>" +
                "<div id = 'c23' class = 'col-md-4' > </div>" +
                "</div>" +
                "<div class = 'row' >" +
                "<div id = 'c31' class = 'col-md-4' > </div>" +
                "<div id = 'c32' class = 'col-md-4' > </div>" +
                "<div id = 'c33' class = 'col-md-4' > </div>" +
                "</div>");
        createChart("#c11");
        createChart("#c12");
        createChart("#c13");
        createChart("#c21");
        createChart("#c22");
        createChart("#c23");
        createChart("#c31");
        createChart("#c32");
        createChart("#c33");
        function createChart(selector) {
            $(selector).highcharts({
                chart: {
                    type: 'scatter',
                    width: 400,
                    height: 400
                },
                title: {
                    text: ''
                },
                subTitle: {
                    text: ''
                },
                exporting: {
                    enabled: false
                },
                xAxis: {
                    title: {
                        enabled: true,
                        text: '<?php echo $chart["xAxis"]["title"] ?>'
                    },
                    startOnTick: true,
                    endOnTick: true,
                    showLastLabel: true,
                    min: 0
                },
                yAxis: {
                    title: {
                        text: '<?php echo $chart["yAxis"]["title"] ?>'
                    }
                },
                legend: {
                    enabled: false
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

                    }]
            });
        }
    });
</script>