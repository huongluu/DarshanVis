$(function () {
    var globalCallback = function (chart) {
        // Specific event listener
        Highcharts.addEvent(chart.container, 'click', function (e) {
            e = chart.pointer.normalize();
            console.log('Clicked chart at ' + e.chartX + ', ' + e.chartY);
        });
        // Specific event listener
        Highcharts.addEvent(chart.xAxis[0], 'afterSetExtremes', function (e) {
            console.log('Set extremes to ' + e.min + ', ' + e.max);
        });
        Highcharts.addEvent(chart, 'load', function (e) {
            //                e = chart.pointer.normalize();
            console.log('loaded');
            var chart = this,
                    legend = chart.legend;
            if (typeof legend.allItems != 'undefined') {
                for (var i = 0, len = legend.allItems.length; i < len; i++) {
                    (function (i) {
                        var item = legend.allItems[i].legendItem;
                        item.on('mouseover', function (e) {
                            //show custom tooltip here
                            console.log("mouseover" + i);
                            //                            $('#tooltips').tooltip();
                            $("#tooltip" + (i + 1)).tooltip('show');
                        }).on('mouseout', function (e) {
                            //hide tooltip
                            console.log("mouseout" + i);
                            $("#tooltip" + (i + 1)).tooltip('hide');
                        });
                    })(i);
                }
            }
        });
    }

    // Add `globalCallback` to the list of highcharts callbacks
    Highcharts.Chart.prototype.callbacks.push(globalCallback);

});