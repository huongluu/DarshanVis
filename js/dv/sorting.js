jQuery(document).ready(function ($) {

    var chartId = getChartIdFromURL(window.location.href);
    console.log(chartId);
    getChart(chartId, function (chart) {
        console.log("in the sorting >>>>>>>>>>>>>");
        var options = chart.sorting;
        var labels = []
        for (var i = 0; i < chart.series.length; i++) {
            labels[chart.series[i].attribute] = chart.series[i].name;
        }
        populateDropdown(".sortpicker", options, labels);
    });

    $('#sort-level1').on('change', function () {
    });

    $("#s-level2").css("visibility", "hidden");
    $("#s-level3").css("visibility", "hidden");

    $("#add-level2").click(function () {
        $("#s-level2").css("visibility", "visible");
    });

    $("#add-level3").click(function () {
        $("#s-level3").css("visibility", "visible");
    });
});
