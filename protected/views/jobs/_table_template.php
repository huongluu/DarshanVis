<?php

include_once 'utils.php';
$id = $_GET['c'];
$chart = getChartInfo($id);
if (isset($chart['table'])) {
    $table = $chart['table']['template'];
    $table_path = __DIR__ . '/../' . $table;
    include_once $table_path;
}
?>


