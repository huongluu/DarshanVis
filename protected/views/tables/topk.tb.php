<?php
$data = Jobs::execSQLQuery($chart["table"]["query"]);
//print_r($data);
//echo $series_str;
?>

<div class="container">

    <table id="dv_table" class="table table-striped table-bordered text-right" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Number of jobs</th>
                <th>Total Runtime (hours)</th>
                <th>Total I/O Time (hours)</th>
                <th>Total Amount of Data Read/Written</th>
                <th>Average Percentage of Runtime in I/O</th>
                <th>Median I/O Thruput (GB/s)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1;
            foreach ($data as $d) {
                echo "<tr>";
                echo "<td>" . $index . "</td>";
                echo "<td>" . $d['appname'] . "</td>";
                echo "<td>" . round($d['numjobs']) . "</td>";
                echo "<td>" . round($d['total_runtime_h']) . "</td>";
                echo "<td>" . round($d['total_iotime_h']) . "</td>";
                echo "<td>" . round($d['total_bytes_TB']) ." TB" ."</td>";
                echo "<td>" . round($d['avg_io_percentage']) ."%". "</td>";
                echo "<td>" . round($d['avg_perf_GB'],2) . "</td>";
                echo "</tr>";
                $index++;
            }
            ?>
        </tbody>
    </table>
</div>