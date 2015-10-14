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
    <select id="chart-config-sel-x" class="chart-config-selector">
    </select>
    X Axis Scale
    <select id="chart-config-sel-x-scale" class="chart-config-selector">
        <option value="linear">linear</option>
        <option value="logarithmic">logarithmic</option>
    </select>
    <br>
    Y Axis
    <select id="chart-config-sel-y">
    </select>
    Y Axis Scale
    <select id="chart-config-sel-y-scale" class="chart-config-selector">
        <option value="linear">linear</option>
        <option value="logarithmic">logarithmic</option>
    </select>
    <!-- Point color
    <select id="chart-config-sel-pt">
    </select> -->
    <!-- Point Shape -->
    <!-- <select id> -->
    <button id="chart-config-button" class="btn btn-medium btn-success">Configure Chart</button>
</div>

<?php
include '_table_template.php';
?>
