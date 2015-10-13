<?php
include '_filter_template.php';
//include '/../components/_filters.php';
?>

<?php
include '_chart_template.php';
?>


<div id="chart-container"  style="height: 400px; width: 900px; margin: 0 auto;<?php if ($display_en===false){?>  display:none <?php }?> "></div>
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

<?php
include '_table_template.php';
?>
