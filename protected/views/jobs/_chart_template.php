<?php

$id = $_GET['c'];
$json = file_get_contents("data/charts.json");
$charts = json_decode($json, true);
foreach ($charts as $c) {
    if ($c["id"] == 1) {
        $generic_chart = $c;
    }
    if ($c["id"] == $id) {
        $main_chart = $c;
        break;
    }
}
$chart = array_merge($generic_chart, $main_chart);
if ($chart["type"] == "line") {
    include_once '/../charts/line.js.php';
} else if ($chart["type"] == "heatmap") {
    include_once '/../charts/heatmap.js.php';
} else if ($chart["type"] == "boxplot") {
    include_once '/../charts/boxplot.js.php';
} else if ($chart["type"] == "scatter") {
    include_once '/../charts/scatter.js.php';
} else if ($chart["type"] == "stacked") {
    include_once '/../charts/stacked.js.php';
} 
//print_r($chart);
?>

