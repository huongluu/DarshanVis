<?php
include '_filter_template.php';
//include '/../components/_filters.php';
?>

<?php
include '_chart_template.php';
?>

<div id="chart-container"  style="height: 400px; width: 900px; margin: 0 auto;"></div>
<div id="tooltip-div" style="margin-left: 40%; position: relative; top: -60px; width: 400px;">
    <center>
        <span id="tooltip1"></span>
        <span id="tooltip2"></span>
        <span id="tooltip3"></span>
        <span id="tooltip4"></span>
        <span id="tooltip5"></span>
        <span id="tooltip6"></span>
        <span id="tooltip7"></span>
    </center>
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
    <option value="logarithmic">log10</option>
  </select>
  <br>
  Y Axis
  <select id="chart-config-sel-y" class="chart-config-selector">
  </select>
  Y Axis Scale
  <select id="chart-config-sel-y-scale" class="chart-config-selector">
    <option value="linear">linear</option>
    <option value="logarithmic">log10</option>
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
