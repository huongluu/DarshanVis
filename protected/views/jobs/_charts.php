<?php
include '_filter_template.php';
//include '/../components/_filters.php';
?>

<?php
include '_chart_template.php';
?>

<div id="chart-container"  style="height: 500px; width: 1000px; margin: 0 auto;"></div>

<div id="min_max_button_div" style="width: 100wh; text-align: center;" hidden>
  <button id="min_max_button" class="btn btn-large btn-primary">Constant Min/Max Toggle</button>
</div>

<div id="15-scatter-containers" hidden>
    <div class="row">
        <div id="chart-container-1" class="col-md-4 charts" style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-2" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-3" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-4" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-5" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-6" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-7" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-8" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-9" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-10" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-11" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-12" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-13" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-14" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
        <div id="chart-container-15" class="col-md-4 charts"  style="height: 400px; margin: 0 auto;"></div>
    </div>
</div>

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
    <select id="chart-config-sel-y" class="chart-config-selector">
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
</div>

<?php
include '_table_template.php';
?>
