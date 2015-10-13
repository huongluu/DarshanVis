<?php
$display_en = false;
?>
<script type="text/javascript">
    $(function () {

        function send() {
            var filter = {
                numapp: $("#numapp-textbox").val(),
                application: $("#application-textbox").val(),
                user: $("#user-textbox").val(),
                sort_level1: $("#sort-level1 option:selected").val(),
                mode_level1: $("#mode-level1 option:selected").val(),
                sort_level2: $("#sort-level2 option:selected").val(),
                mode_level2: $("#mode-level2 option:selected").val(),
                sort_level3: $("#sort-level3 option:selected").val(),
                mode_level3: $("#mode-level3 option:selected").val(),
                start_time: $("#reportrange").val(),
                url: window.location.href
            }

            $('#status').html('filtering..');
            $url = 'filter';
//            alert($url);
            $.ajax({
                url: $url,
                type: 'post',
                dataType: 'json',
                success: function (data) {
//                    alert("success");
                    console.log(data);
                    var chart = $('#chart-container').highcharts();
                    while (chart.series.length > 0) {
                        chart.series[0].remove(false);
                    }
                    var series = data["chart"]["series"];
                    var queryResult = data["queryresult"];
                    for (var i = 0; i < series.length; i++) {
                        var attr = series[i]["attribute"];
                        var qr = queryResult[attr];
                        series[i]["data"] = [];
                        for (var j = 0; j < qr.length; j++) {
                            series[i]["data"].push([j, Number(qr[j])]);
                        }
                        console.log(series[i]);
                        chart.addSeries(series[i], false);
                    }
//                    series.forEach(function (s) {
//                        chart.addSeries(s, false);
//                    });

                    chart.redraw();
                    $('#chart-container').css('visibility', 'visible');
                    $('#chart-container').css('display', 'block');
                    $('#status').html('&nbsp;');
//                    $('#target').html(data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    $('#status').html('error!');
                },
                data: filter
            });
        }


        $("#filter-button, #sorting-button").click(function () {
            send();
        });

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

        <div class="form-group col-md-2">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" id="user-textbox" name="user" class="form-control" id="user-typeahead" data-provide="typeahead" placeholder="UserID" autocomplete="off">
            </div>
        </div>

        <div class="form-group col-md-3">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-font" data-toggle="tooltip" data-placement="left" title="My Tooltip text"></i>
                </span>
                <input type="text" id="application-textbox" name="application" class="form-control" id="application-typeahead" data-provide="typeahead" placeholder="Application Name" autocomplete="off">
                <!--<input type="text" class="form-control" placeholder="Application" aria-describedby="basic-addon1">-->
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



