<?php
$display_en = false;
?>
<script type="text/javascript">
    $(function () {


        $("#filter-button, #sorting-button").click(function () {
            send();
        });

        $('#reportrange span').html(moment().subtract(1, 'years').format('MMM DD \'YY') + ' - ' + moment().format('MMM DD \'YY'));
        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(1, 'years'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
//            dateLimit: {
//                days: 60
//            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMM DD \'YY') + ' - ' + end.format('MMM DD \'YY'));
        });

//        alert(datepickerobj.startDate.format('YYYY-MM-DD'));
//        console.log(">>>>>>>>>>>>>>>>>>>>>>>>>> datepicker");
//        console.log(datepickerobj);
        $('#user-textbox').typeahead({
            source: function (query, process) {
                return $.get('UserList', {
                    user: query,
                    application: $("#application-textbox").val() ? $("#application-textbox").val() : "null"
                },
                function (data) {
                    console.log(data);
                    return process(data);
                });
            }
        });

        $('#application-textbox').typeahead({
            source: function (query, process) {
                return $.get('ApplicationList', {
                    application: query,
                    user: $("#user-textbox").val() ? $("#user-textbox").val() : "null"
                },
                function (data) {
                    console.log(data);
                    return process(data);
                });
            }
        });


//        $.get('UserList', function (data) {
//            $("#user-typeahead").typeahead({
//                source: data
//            });
//            console.log(data);
//        }, 'json');
//        $.get('ApplicationList', function (data) {
//            $("#application-textbox").typeahead({
//                source: data
//            });
//            console.log(data);
//        }, 'json');
    });
</script>

<div>
    <div class="row">
        <div class="text-center" id="status">&nbsp;</div>
    </div>
    <div class="row">
        <!--        <div class="form-group col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                        </span>
                        <input type="text" id="numapp-textbox" name="numapp" class="form-control" id="numapp-typeahead" data-provide="typeahead" placeholder="Number of Applications" autocomplete="off">
                    </div>
                </div>-->


        <div class="form-group col-md-3">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-font" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" id="application-textbox" name="application" class="form-control" id="application-typeahead" data-provide="typeahead" placeholder="Application Name" autocomplete="off">
                <!--<input type="text" class="form-control" placeholder="Application" aria-describedby="basic-addon1">-->
            </div>
        </div>

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



