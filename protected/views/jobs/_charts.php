<?php
    include '_filters.php';
    ?>
<?php
//$data = Jobs::execSQLQuery("select real_exe, min(nprocs) as min_jobsize, avg(nprocs) as avg_jobsize, max(nprocs) as max_jobsize from jobs_all group by real_exe limit 0,20");
//print_r($data);
//$s = array_column($data, "real_exe");
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


<div id="chart-container" style="height: 400px; width: 700px; margin: 0 auto"></div>

<?php
include '_sorting.php';
?>

<?php
include '_chart_table.php';
?>
