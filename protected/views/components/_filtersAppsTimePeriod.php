<?php
//$date_data = Jobs::execSQLQuery("select min(start_time), max(start_time) from jobs_info;");

$app_placeholder = "Application Name";
if (isset($_POST["application"]) && strlen($_POST["application"]) > 0) {
    $app_placeholder = $_POST["application"];
}

$user_placeholder = "UserID";
if (isset($_POST["user"]) && strlen($_POST["user"]) > 0) {
    $user_placeholder = $_POST["user"];
}

$numapp_placeholder = "Number of Applications";
if (isset($_POST["numapp"]) && strlen($_POST["numapp"]) > 0) {
    $numapp_placeholder = $_POST["numapp"];
}
?>
<script type="text/javascript">
    $(function () {

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMM DD \'YY') + ' - ' + moment().format('MMM DD \'YY'));

        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(30, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {
                days: 60
            },
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



        $.get('UserList', function (data) {
            $("#user-typeahead").typeahead({
                source: data
            });
//            console.log(data);
        }, 'json');

        $.get('ApplicationList', function (data) {
            $("#application-typeahead").typeahead({
                source: data
            });
//            console.log(data);
        }, 'json');

    });
</script>

<form role="form" method="post">
    <div class="row">
        <div class="form-group col-md-4">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" name="numapp" class="form-control" id="numapp-typeahead" data-provide="typeahead" placeholder="<?php echo $numapp_placeholder; ?>" autocomplete="off">
            </div>
        </div>

        <div class="form-group col-md-3">
            <div id="reportrange" class="form-control" style="background: #fff; cursor: pointer; padding: 0px 5px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span></span> <b class="caret"></b>
            </div>
        </div>

        <div class="col-md-1 form-group">
            <button type="submit" class="btn btn-inverse tiny-button">Update</button>
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
</form>

<div class="row">
    <div class="col-md-2 form-group">
        <button style="font-size: 150%;" type="button" id="toggle-percentage" class="btn tiny-button">
            %</button>
    </div>
</div>



