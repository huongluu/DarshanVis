<?php
$data = Jobs::execSQLQuery($chart["series"][0]["query"]);
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
                <th data-field="name" data-sortable="true">Name</th>
                <th data-field="ave_jobsize" data-sortable="true">Ave Jobsize</th>
                <th data-field="agg_perf" data-sortable="true">Agg Perf</th>
                <th data-field="total_bytes" data-sortable="true">Total Bytes</th>
                <th data-field="runtime" data-sortable="true">Runtime</th>
                <th data-field="iotime" data-sortable="true">IOTime</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1;
            foreach ($data as $d) {
                echo "<tr>";
                echo "<td>" . $index . "</td>";
                echo "<td>" . $d['real_exe'] . "</td>";
                echo "<td>" . round($d['avg_jobsize']) . "</td>";
                echo "<td>" . round($d['max_jobsize']) . "</td>";
                echo "<td>" . round($d['total_bytes']) . "</td>";
                echo "<td>" . round($d['runtime']) . "</td>";
                echo "<td>" . round($d['iotime']) . "</td>";
                echo "</tr>";
                $index++;
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    var $table = $('#table');
    $(function() {
        $('#toolbar').find('select').change(function() {
            $table.bootstrapTable('refreshOptions', {
                exportDataType: $(this).val()
            });
        });
    })
</script>