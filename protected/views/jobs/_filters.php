<script type="text/javascript">
    $(function() {

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

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
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

    });
</script>

<form role="form" method="post">
    <div class="row">
        <div class="form-group col-md-3">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="UserId" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <i class="glyphicon glyphicon-cog"></i>
                </span>
                <input type="text" class="form-control" placeholder="Application/Project" aria-describedby="basic-addon1">
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

            <div class="col-md-2 input-group form-group">
                <span class = "input-group-addon" style = "background-color: white;">Sort</span>
                <select name="orderby"  class="form-control selectpicker">
                    <option value="localio">Non-global data I/O</option>
                    <option value="localmeta" >Non-global Metadata</option>
                    <option value="globalio" >Global data I/O</option>
                    <option value="globalmeta" >Global Metadata</option>
                    <option value="notio" >Not I/O</option>
                    <option value="nprocs" >Number of Proc.</option>
                    <option value="total_bytes" >Total Bytes</option>

                </select>
            </div>
        </div>

        <?php
    }
    ?>


    <div class="row">
        <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-default">Update</button>
        </div>
    </div>
</form>



