<?php
include '_filters.php';
?>
<?php
//$data = Jobs::execSQLQuery("select appname, min(nprocs) as min_jobsize, avg(nprocs) as avg_jobsize, max(nprocs) as max_jobsize from jobs_info group by appname limit 0,20");
//print_r($data);
//$s = array_column($data, "appname");
//implode(",", ))
?>

<pre id="csv" style="display: none">Total Bytes,I/O Throughput,Jobs Count
    <?php
    include '_chart_data.php';
    ?>
</pre>

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
include '_chart_table.php';
?>
