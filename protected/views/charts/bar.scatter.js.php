<?php
include_once 'utils2.php';
if (isset($_POST["orderby"])) {
    $orderby = $_POST["orderby"];
} else {
    $orderby = "globalmeta";
}
if ($orderby != "nprocs" && $orderby != "total_bytes") {
    $orderby = $orderby . "/(runtime + shared_time_by_cumul_io_only - shared_time_by_cumul_meta_only)";
}
$q = $chart["series"][0]["query"];
$q = Jobs::OrderBy($q, $orderby);
$q = Jobs::Limit($q, 2000);
if (isset($_POST["application"])) {
    $q = Jobs::filter($q, "real_exe", $_POST["application"]);
}
if (isset($_POST["user"])) {
    $q = Jobs::filter($q, "uid", $_POST["user"]);
}
$data = Jobs::execSQLQuery($q);
//print_r($data);
//$cats_str = "";
$series_str = array();
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
//echo $series_str;
?>
<script type="text/javascript">
    $(function() {
        $('#chart-container').highcharts({
<?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>

            series: [{
                    name: '<?php echo $chart["series"][0]["title1"] ?>',
                    type: 'column',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo $series_str[$chart["series"][0]["attr1"]] ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title2"] ?>',
                    type: 'column',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo $series_str[$chart["series"][0]["attr2"]] ?>]
//                    tooltip: {
//                        valueSuffix: ' mm'
//                    }
                },
                {
                    name: '<?php echo $chart["series"][0]["title3"] ?>',
                    type: 'column',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo $series_str[$chart["series"][0]["attr3"]] ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title4"] ?>',
                    type: 'column',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo $series_str[$chart["series"][0]["attr4"]] ?>]
                },
                {
                    name: '<?php echo $chart["series"][0]["title5"] ?>',
                    type: 'column',
                    stacking: 'percent',
//                    yAxis: 1,
                    data: [<?php echo $series_str[$chart["series"][0]["attr5"]] ?>]
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
                        radius: 2
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
                        fillColor: '#66FF66',
                        radius: 2
                    },
                    yAxis: 2,
                    data: [<?php echo $series_str[$chart["series"][0]["attr7"]] ?>],
                }]
        });
    });
</script>