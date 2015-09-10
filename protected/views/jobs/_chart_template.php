<?php

include_once 'utils.php';
$id = $_GET['c'];
$chart = getChartInfo($id);

if ($chart["type"] == "line") {
    include_once dirname(__FILE__) . '/../charts/line.js.php';
} else if ($chart["type"] == "percentage_line") {
    include_once dirname(__FILE__) . '/../charts/percentage_line.js.php';
} else if ($chart["type"] == "heatmap") {
    include_once dirname(__FILE__) . '/../charts/heatmap.js.php';
} else if ($chart["type"] == "boxplot") {
    include_once dirname(__FILE__) . '/../charts/boxplot.js.php';
} else if ($chart["type"] == "scatter") {
    include_once dirname(__FILE__) . '/../charts/scatter.js.php';
} else if ($chart["type"] == "stacked") {
    include_once dirname(__FILE__) . '/../charts/stacked.js.php';
} else if ($chart["type"] == "bar.scatter") {
    include_once dirname(__FILE__) . '/../charts/bar.scatter.js.php';
} else if ($chart["type"] == "scatterset") {
    include_once dirname(__FILE__) . '/../charts/scatterset.js.php';
}
//print_r($chart);
?>

