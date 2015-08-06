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
if ($chart["type"] == "boxplot") {
    include_once '/../tables/topk.tb.php';
}
//print_r($chart);
?>

