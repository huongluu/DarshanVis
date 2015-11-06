var charts;


function roundSF(num, n) {
    if (num == 0) {
        return 0;
    }

    var d = Math.ceil(Math.log10(num < 0 ? -num : num));
    var power = n - d;

    var magnitude = Math.pow(10, power);
    var shifted = Math.round(num * magnitude);
    return shifted / magnitude;
}

function byte_formatter(c, suffix) {
    var bytes = c.value * 1000 * 1000;
    var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'EB'];
    if (bytes == 0) {
        return '0 B';
    }
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1000)));
    return Math.round(bytes / Math.pow(1000, i), 2) + ' ' + sizes[i] + suffix;
}


function getChartIdFromURL(url) {
    var pos = url.indexOf("?");
    var chartId = url.substr(pos + 3);
    return chartId;
}


function populateDropdown(selector, options, labels) {
    var str = "";

    for (var i = 0; i < options.length; i++) {
        str += '<option value="' + options[i] + '">' + labels[options[i]] + '</option>';
    }

    $(selector).append(str);
    $(selector).selectpicker('refresh');
}