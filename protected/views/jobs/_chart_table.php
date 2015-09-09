<?php

include_once 'utils.php';
$id = $_GET['c'];
$chart = getChartInfo($id);

if ($chart["type"] == "boxplot") {
    include_once dirname(__FILE__) . '/../tables/topk.tb.php';
}
//print_r($chart);
?>

