<?php
include '_filter_template.php';
//include '/../components/_filters.php';
?>

<?php
include '_chart_template.php';
?>


<div id="chart-container"  style="height: 400px; width: 900px; margin: 0 auto;"></div>


<div id="chart-config" hidden>
    X Axis
    <select id="chart-config-sel-x">
    </select>
    Y Axis
    <select id="chart-config-sel-y">
    </select>
    <button id="chart-config-button" class="btn btn-medium btn-success">Configure Chart</button>
</div>

<?php
include '_table_template.php';
?>
