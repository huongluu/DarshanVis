<script type="text/javascript">
    $(function() {

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMM DD \'YY') + ' - ' + moment().format('MMM DD \'YY'));

        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(29, 'days'),
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
        function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMM DD \'YY') + ' - ' + end.format('MMM DD \'YY'));
        });



        $.get('UserList', function(data) {
            $("#user-typeahead").typeahead({
                source: data
            });
//            console.log(data);
        }, 'json');

        $.get('ApplicationList', function(data) {
            $("#application-typeahead").typeahead({
                source: data
            });
//            console.log(data);
        }, 'json');

    });
</script>

<form role="form" method="post">
    <div class="row">
        <div class="form-group col-md-2">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" class="form-control" id="user-typeahead" data-provide="typeahead" placeholder="UserID">
            </div>
        </div>

        <div class="form-group col-md-3">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-font" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" class="form-control" id="application-typeahead" data-provide="typeahead" placeholder="Application Name">
                <!--<input type="text" class="form-control" placeholder="Application" aria-describedby="basic-addon1">-->
            </div>
        </div>

        <div class="form-group col-md-3">
            <div id="reportrange" class="form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span></span> <b class="caret"></b>
            </div>
        </div>

        <?php
        $id = $_GET['c'];
        if ($id == 12) {
            ?>

            <div class="col-md-3 form-group">
                <div class="input-group">

                    <span class="input-group-addon" id="basic-addon1">
                        <i class="glyphicon glyphicon-sort-by-alphabet"></i>
                    </span>
                    <!--<span class = "input-group-addon" style = "background-color: white;">Sort</span>-->
                    <select name="orderby"  class="form-control selectpicker">
                        <?php
//                    for ($i = 1; $i <= 6; $i++) {
//                        echo $chart["series"][0]["attr" . $i];
//                    }
                        ?>

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

            <div class="col-md-1 form-group">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </div>


        <?php
    }
    ?>

    <!--
        <div class="row">
    
        </div>-->


</form>



