<?php
include_once 'utils2.php';
$q = $chart["series"][0]["query"];

$orderby = "start_time";
if (isset($_POST["sort-level1"])) {
    $orderby = $_POST["sort-level1"];
}
//if ($orderby != "nprocs" && $orderby != "total_bytes") {
//    $orderby = $orderby . "/(runtime + shared_time_by_cumul_io_only - shared_time_by_cumul_meta_only)";
//}
$mode1 = "desc";
if (isset($_POST["mode-level1"])) {
//    echo "set to ". $_POST["mode-level1"];
    $mode1 = $_POST["mode-level1"];
}

//$orderby = "notio" . "/(runtime + shared_time_by_cumul_io_only - shared_time_by_cumul_meta_only) asc";
//$orderby .= ", globalio";

$q = Jobs::OrderBy($q, $orderby, $mode1);
$q = Jobs::Limit($q, 2000);

if (isset($_POST["sort-level2"])) {
    $sortlevel2 = $_POST["sort-level2"];
    $mode2 = "desc";
    if (isset($_POST["mode-level2"])) {
        $mode1 = $_POST["mode-level2"];
    }
    $q = Jobs::addSortingLevel($q, $sortlevel2, $mode2);
}

if (isset($_POST["sort-level3"])) {
    $sortlevel3 = $_POST["sort-level3"];
    $mode3 = "desc";
    if (isset($_POST["mode-level3"])) {
        $mode1 = $_POST["mode-level3"];
    }
    $q = Jobs::addSortingLevel($q, $sortlevel3, $mode3);
}

if (isset($_POST["application"]) && strlen($_POST["application"]) > 0) {
    $q = Jobs::filter($q, "appname", $_POST["application"]);
}
if (isset($_POST["user"]) && strlen($_POST["user"]) > 0) {
    $q = Jobs::filter($q, "uid", $_POST["user"]);
}
$data = Jobs::execSQLQuery($q);
//print_r($data);
//$cats_str = "";

$series_str = array();
if (sizeof($data) > 0) {
    $attr_count = 7;
    foreach ($data as $d) {
        for ($i = 1; $i <= $attr_count; $i++) {
            if (!isset($series_str[$chart["series"][0]["attr" . $i]])) {
                $series_str[$chart["series"][0]["attr" . $i]] = "";
            }
            $num = $d[$chart["series"][0]["attr" . $i]];
            if (strpos($num, ".") == true) {
                $num = round($num, 1);
            }
            $series_str[$chart["series"][0]["attr" . $i]] .= ($num) . ',';
        }
//    $cats_str .= '\'' . $d[$chart["xAxis"]["attribute"]] . '\'' . ',';
//    $series_str .= '[' . $d[$chart["series"][0]["min"]] . ',' . ($d[$chart["series"][0]["q1"]] * 2) . ',' . $d[$chart["series"][0]["median"]] . ',' . ($d[$chart["series"][0]["q3"]] * 0.5) . ',' . $d[$chart["series"][0]["max"]] . '],';
    }
//$cats_str = rtrim($cats_str, ",");

    for ($i = 1; $i <= $attr_count; $i++) {
        $series_str[$chart["series"][0]["attr" . $i]] = rtrim($series_str[$chart["series"][0]["attr" . $i]], ",");
    }
}
//echo $series_str;
?>
<script type="text/javascript">

    $(function() {
        $('#tooltip1').tooltip({
            title:
                    'Non-global data I/O: The amount of time this job spent in function calls to read/write its files not accessed by all processes.'
        });
        $('#tooltip2').tooltip({
            title:
                    'Non-global Metadata: The amount of time this job spent in metadata function calls (open, close, seek, etc.) for non-global files, i.e., files that one or more but not all processes opened.'
        });
        $('#tooltip3').tooltip({
            title:
                    'Global data I/O: The amount of time this job spent in function calls to read/write global files, i.e., files that all processes opened.'
        });
        $('#tooltip4').tooltip({
            title:
                    'Global Metadata: The amount of time this job spent in metadata function calls (open, close, seek, etc.) for global files, i.e., files that all processes opened.'
        });
        $('#tooltip5').tooltip({
            title:
                    'Not I/O: The amount of time this job spent outside of I/O function calls (data and metadata).'
        });
        $('#tooltip6').tooltip({
            title:
                    '# of Processes: The number of processes this job had.'
        });
        $('#tooltip7').tooltip({
            title:
                    'Total Bytes Read/Written: The total number of bytes this job read and wrote.'
        });
//        $("#tooltip1").tooltip('show');
//        $('[data-toggle="tooltip"]').tooltip();
        var globalCallback = function(chart) {
            // Specific event listener
            Highcharts.addEvent(chart.container, 'click', function(e) {
                e = chart.pointer.normalize();
                console.log('Clicked chart at ' + e.chartX + ', ' + e.chartY);
            });
            // Specific event listener
            Highcharts.addEvent(chart.xAxis[0], 'afterSetExtremes', function(e) {
                console.log('Set extremes to ' + e.min + ', ' + e.max);
            });
            Highcharts.addEvent(chart, 'load', function(e) {
//                e = chart.pointer.normalize();
                console.log('loaded');
                var chart = this,
                        legend = chart.legend;
                for (var i = 0, len = legend.allItems.length; i < len; i++) {
                    (function(i) {
                        var item = legend.allItems[i].legendItem;
                        item.on('mouseover', function(e) {
                            //show custom tooltip here
                            console.log("mouseover" + i);
//                            $('#tooltips').tooltip();
                            $("#tooltip" + (i + 1)).tooltip('show');
                        }).on('mouseout', function(e) {
                            //hide tooltip
                            console.log("mouseout" + i);
                            $("#tooltip" + (i + 1)).tooltip('hide');
                        });
                    })(i);
                }
            });
        }

// Add `globalCallback` to the list of highcharts callbacks
        Highcharts.Chart.prototype.callbacks.push(globalCallback);
        $('#chart-container').highcharts({
<?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>

            series: [{
                    name: '<?php echo $chart["series"][0]["title1"] ?>',
                    type: 'column',
                    color: '#5C9430',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[$chart["series"][0]["attr1"]]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title2"] ?>',
                    type: 'column',
                    color: '#C73308',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[$chart["series"][0]["attr2"]]); ?>]
//                    tooltip: {
//                        valueSuffix: ' mm'
//                    }
                },
                {
                    name: '<?php echo $chart["series"][0]["title3"] ?>',
                    type: 'column',
                    color: '#68DB49',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[$chart["series"][0]["attr3"]]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title4"] ?>',
                    type: 'column',
                    color: '#F25B47',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[$chart["series"][0]["attr4"]]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title5"] ?>',
                    type: 'column',
                    color: '#BDD0D5',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo nullSafe($series_str[$chart["series"][0]["attr5"]]); ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title6"] ?>',
                    type: 'scatter',
                    yAxis: 1,
                    data: [<?php echo $series_str[$chart["series"][0]["attr6"]] ?>],
                    lineWidth: 0,
                    visible: false,
                    marker: {
                        symbol: 'diamond',
                        enabled: true,
                        radius: 1,
                        fillColor: '#7F77B4'
                    },
                    dashStyle: 'shortdot'
                }, {
                    name: '<?php echo $chart["series"][0]["title7"] ?>',
                    type: 'scatter',
                    lineWidth: 0,
                    visible: false,
                    marker: {
                        symbol: 'circle',
                        enabled: true,
                        fillColor: '#BF53B4',
                        radius: 1
                    },
                    yAxis: 2,
                    data: [<?php echo $series_str[$chart["series"][0]["attr7"]] ?>],
                }]
        });

        var chart = $('#chart-container').highcharts();
        var color = false;
        var stacking = false;
        console.log(">>>>>>>>>>>");
        console.log(chart);
// Toggle abs/%
        $('#toggle-percentage').click(function() {
            for (var i = 0; i < 5; i++) {
                chart.series[i].update({
                    stacking: stacking ? "percent" : "normal"
                });
            }
//            chart.yAxis[0].update({
//                label.format: stacking ? "{value}%" : "{value}"
//            });
            stacking = !stacking;
//            chart.series[0].update({
//                color: color ? null : Highcharts.getOptions().colors[1]
//            });
//            color = !color;
        });

    });
</script>
