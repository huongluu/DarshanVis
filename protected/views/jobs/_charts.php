<?php
include '_filter_template.php';
//include '/../components/_filters.php';
?>

<?php
include '_chart_template.php';
?>


<div id="chart-container"  style="height: 400px; width: 900px; margin: 0 auto;"></div>
<div style="margin-left: 40%; position: relative; top: -60px; width: 400px;">
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

<div id="chart-config" hidden>
  <p>X Axis</p>
  <select id="chart-config-sel-x">
  </select>
  <p>Y Axis</p>
  <select id="chart-config-sel-y">
  </select>
  <button id="chart-config-button" class="btn btn-medium btn-success">Configure Chart</button>
</div>

<?php
include '_table_template.php';
?>
