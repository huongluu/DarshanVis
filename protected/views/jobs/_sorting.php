<div class="row">
    <?php
    $id = $_GET['c'];
    if ($id == 12) {
        ?>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="orderby" id="sort-level1" class="form-control selectpicker">
                    <option value="localio">Non-global Data I/O</option>
                    <option value="localmeta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="globalmeta" >Global Metadata</option>
                    <option value="notio" >Not I/O</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>

                </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="input-group">

                <span class="input-group-addon" id="basic-addon2">
                    <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                </span>
                <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                <select name="orderby" id="sort-level2" class="form-control selectpicker">
                    <option value="localio">Non-global Data I/O</option>
                    <option value="localmeta" >Non-global Metadata</option>
                    <option value="globalio" >Global Data I/O</option>
                    <option value="globalmeta" >Global Metadata</option>
                    <option value="notio" >Not I/O</option>
                    <option value="nprocs" ># of Processes</option>
                    <option value="total_bytes" >Total Bytes Read/Written</option>

                </select>
            </div>
        </div>

        <?php
    }
    ?>
</div>