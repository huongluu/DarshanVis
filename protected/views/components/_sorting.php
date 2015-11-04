

<?php

$id = $_GET['c'];
if ($id == 12) {
    ?>



    <script type="text/javascript">
        $(function() {
            $("#s-level2").css("visibility", "hidden");
            $("#s-level3").css("visibility", "hidden");

            $("#add-level2").click(function() {
                $("#s-level2").css("visibility", "visible");
            });

            $("#add-level3").click(function() {
                $("#s-level3").css("visibility", "visible");
            });
        });
    </script>

    <div class="row" id="s-level1">
        <div class="col-md-2 form-group text-center">
            Sort by
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="sort-level1" id="sort-level1" class="form-control selectpicker">
                    <option disabled selected></option>
                    <option value="notio" >Not I/O Time</option>
                    <option value="iotime" >I/O Time</option>
                    <option value="io_percent" >Percentage of runtime spent in I/O</option>
                    <option value="localio">Non-global Data I/O</option>
                    <option value="local_meta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="global_meta" >Global Metadata</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>
                    <option value="agg_perf_MB" >I/O Throughput</option>
                    <option value="unique_count" >Number of local files</option>
                    <option value="partshared_count" >Number of partshared files</option>
                    <option value="allshared_count" >Number of global files</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    Order
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="mode-level1" id="mode-level1" class="form-control selectpicker">
                    <option value="asc">Smallest to Largest</option>
                    <option value="desc" >Largest to Smallest</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 form-group">
            <button type="button" id="add-level2" class="btn tiny-button">
                Add Level</button>
        </div>
    </div>


    <!-- Level 2 -->

    <div class="row" id="s-level2">
        <div class="col-md-2 form-group text-center">
            Then by
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="sort-level2" id="sort-level2" class="form-control selectpicker">
                    <option disabled selected></option>
                    <option value="notio" >Not I/O Time</option>
                    <option value="iotime" >I/O Time</option>
                    <option value="io_percent" >Percentage of runtime spent in I/O</option>
                    <option value="localio">Non-global Data I/O</option>
                    <option value="local_meta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="global_meta" >Global Metadata</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>
                    <option value="agg_perf_MB" >I/O Throughput</option>
                    <option value="unique_count" >Number of local files</option>
                    <option value="partshared_count" >Number of partshared files</option>
                    <option value="allshared_count" >Number of global files</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    Order
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="mode-level2" id="mode-level2" class="form-control selectpicker">
                    <option value="asc">Smallest to Largest</option>
                    <option value="desc" >Largest to Smallest</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 form-group">
            <button type="button" id="add-level3" class="btn tiny-button">
                Add Level</button>
        </div>
    </div>


    <!-- Level 3 -->
    <div class="row" id="s-level3">
        <div class="col-md-2 form-group text-center">
            Then by
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="sort-level3" id="sort-level3" class="form-control selectpicker">
                    <option disabled selected></option>
                    <option value="notio" >Not I/O Time</option>
                    <option value="iotime" >I/O Time</option>
                    <option value="io_percent" >Percentage of runtime spent in I/O</option>
                    <option value="localio">Non-global Data I/O</option>
                    <option value="local_meta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="global_meta" >Global Metadata</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>
                    <option value="agg_perf_MB" >I/O Throughput</option>
                    <option value="unique_count" >Number of local files</option>
                    <option value="partshared_count" >Number of partshared files</option>
                    <option value="allshared_count" >Number of global files</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    Order
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="mode-level3" id="mode-level3" class="form-control selectpicker">
                    <option value="asc">Smallest to Largest</option>
                    <option value="desc" >Largest to Smallest</option>
                </select>
            </div>
        </div>
    </div>

    <?php

}

?>



<?php

$id = $_GET['c'];
if ($id == 8) {
    ?>



    <script type="text/javascript">
        $(function() {
            $("#s-level2").css("visibility", "hidden");
            $("#s-level3").css("visibility", "hidden");

            $("#add-level2").click(function() {
                $("#s-level2").css("visibility", "visible");
            });

            $("#add-level3").click(function() {
                $("#s-level3").css("visibility", "visible");
            });
        });
    </script>

    <div class="row" id="s-level1">
        <div class="col-md-2 form-group text-center">
            Sort by
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="sort-level1" id="sort-level1" class="form-control selectpicker">
                    <option disabled selected></option>
                    <option value="max_thruput" >max throughput</option>
                    <option value="median_thruput" >median throughput</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    Order
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="mode-level1" id="mode-level1" class="form-control selectpicker">
                    <option value="asc">Smallest to Largest</option>
                    <option value="desc" >Largest to Smallest</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 form-group">
            <button type="button" id="add-level2" class="btn tiny-button">
                Add Level</button>
        </div>
    </div>


    <!-- Level 2 -->

    <div class="row" id="s-level2">
        <div class="col-md-2 form-group text-center">
            Then by
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="sort-level2" id="sort-level2" class="form-control selectpicker">
                    <option disabled selected></option>
                    <option value="notio" >Not I/O Time</option>
                    <option value="iotime" >I/O Time</option>
                    <option value="io_percent" >Percentage of runtime spent in I/O</option>
                    <option value="localio">Non-global Data I/O</option>
                    <option value="local_meta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="global_meta" >Global Metadata</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>
                    <option value="agg_perf_MB" >I/O Throughput</option>
                    <option value="unique_count" >Number of local files</option>
                    <option value="partshared_count" >Number of partshared files</option>
                    <option value="allshared_count" >Number of global files</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    Order
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="mode-level2" id="mode-level2" class="form-control selectpicker">
                    <option value="asc">Smallest to Largest</option>
                    <option value="desc" >Largest to Smallest</option>
                </select>
            </div>
        </div>
        <div class="col-md-2 form-group">
            <button type="button" id="add-level3" class="btn tiny-button">
                Add Level</button>
        </div>
    </div>


    <!-- Level 3 -->
    <div class="row" id="s-level3">
        <div class="col-md-2 form-group text-center">
            Then by
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="sort-level3" id="sort-level3" class="form-control selectpicker">
                    <option disabled selected></option>
                    <option value="notio" >Not I/O Time</option>
                    <option value="iotime" >I/O Time</option>
                    <option value="io_percent" >Percentage of runtime spent in I/O</option>
                    <option value="localio">Non-global Data I/O</option>
                    <option value="local_meta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="global_meta" >Global Metadata</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>
                    <option value="agg_perf_MB" >I/O Throughput</option>
                    <option value="unique_count" >Number of local files</option>
                    <option value="partshared_count" >Number of partshared files</option>
                    <option value="allshared_count" >Number of global files</option>
                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    Order
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="mode-level3" id="mode-level3" class="form-control selectpicker">
                    <option value="asc">Smallest to Largest</option>
                    <option value="desc" >Largest to Smallest</option>
                </select>
            </div>
        </div>
    </div>

    <?php

}

?>





