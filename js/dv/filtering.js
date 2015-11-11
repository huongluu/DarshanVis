$(function () {


    $("#filter-button, #sorting-button").click(function () {
        var chartId = getChartIdFromURL(window.location.href);
            send();
    });

    $('#reportrange span').html(moment().subtract(1, 'years').add(1, 'days').format('MMM DD \'YY') + ' - ' + moment().format('MMM DD \'YY'));
    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(1, 'years').add(1, 'days'),
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