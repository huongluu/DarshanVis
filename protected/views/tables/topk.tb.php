<?php
$data = Jobs::execSQLQuery($chart["table"]["query"]);
//print_r($data);
//echo $series_str;
?>

<div class="container">

    <div id="toolbar">
        <select class="form-control">
            <option value="">Export Basic</option>
            <option value="all">Export All</option>
            <option value="selected">Export Selected</option>
        </select>
    </div>
    <table id="table"
           data-toggle="table"
           data-show-export="true"
           data-click-to-select="true"
           data-toolbar="#toolbar"
           data-sort-name="ID"
           data-sort-order="desc">
        <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th class="small-font" data-field="appname" data-sortable="true">Name</th>
                <th class="small-font" data-halign="center" data-align="right" data-field="total_runtime_h" data-sortable="true">Total Runtime<br>(hours)</th>
                <th class="small-font" data-halign="center" data-align="right" data-field="total_iotime_h" data-sortable="true">Total I/O<br>Time (hours)</th>
                <th class="small-font" data-halign="center" data-align="right" data-field="total_bytes_TB" data-sortable="true">Total<br>Bytes (TB)</th>
                <th class="small-font" data-halign="center" data-align="right" data-field="numjobs" data-sortable="true">Number<br>of jobs</th>
                <th class="small-font" data-halign="center" data-align="right" data-field="avg_io_percentage" data-sortable="true">Average I/O<br>Percentage</th>
                <th class="small-font" data-halign="center" data-align="right" data-field="avg_perf_GB" data-sortable="true">Average I/O<br>Thruput<br>(GB/s)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1;
            foreach ($data as $d) {
                echo "<tr>";
                echo "<td>" . $index . "</td>";
                echo "<td>" . $d['appname'] . "</td>";
                echo "<td>" . round($d['total_runtime_h']) . "</td>";
                echo "<td>" . round($d['total_iotime_h']) . "</td>";
                echo "<td>" . round($d['total_bytes_TB']) . "</td>";
                echo "<td>" . round($d['numjobs']) . "</td>";
                echo "<td>" . round($d['avg_io_percentage']) . "</td>";
                echo "<td>" . round($d['avg_perf_GB']) . "</td>";
                echo "</tr>";
                $index++;
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    var $table = $('#table');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('refreshOptions', {
                exportDataType: $(this).val()
            });
        });
    })
</script>