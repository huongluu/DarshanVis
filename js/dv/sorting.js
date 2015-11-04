jQuery(document).ready(function ($) {
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

