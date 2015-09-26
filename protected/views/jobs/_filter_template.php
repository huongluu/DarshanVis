<?php

include_once 'utils.php';
$id = $_GET['c'];
$chart = getChartInfo($id);
$filter = $chart['filter'];
$filter_path = __DIR__ . '/../' . $filter;
include_once $filter_path;
?>

