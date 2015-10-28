<?php
$display_en = false;
?>

<div>
    <div class="row">
        <div class="text-center" id="status">&nbsp;</div>
    </div>
    <div class="row">

        <div class="form-group col-md-2">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" id="user-textbox" name="user" class="form-control" id="user-typeahead" data-provide="typeahead" placeholder="UserID" autocomplete="off">
            </div>
        </div>

        <div class="form-group col-md-3">
            <div id="reportrange" class="form-control" style="background: #fff; cursor: pointer; padding: 0px 5px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span></span> <b class="caret"></b>
            </div>
        </div>

        <div class="col-md-1 form-group">
            <button id="filter-button" class="btn btn-inverse tiny-button">Update</button>
        </div>

        <div class="col-md-1 form-group">
            <button type="button" class="btn tiny-button" data-toggle="modal" href="#sorting_modal">
                <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                Sort</button>
        </div>
    </div>

    <!--
        <div class="row">
    
        </div>-->

    <?php include '_sorting_modal.php'; ?>
</div>

<div class="row">
    <div class="col-md-2 form-group">
        <button style="font-size: 150%;" type="button" id="toggle-percentage" class="btn tiny-button">
            %</button>
    </div>
</div>



