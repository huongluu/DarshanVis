var charts;


var sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB'];
var num_sizes = ['', 'K', 'M', 'B', 'Tr', '', ''];

function byte_formatter(c, suffix) {
    return byte_formatter_general(c, suffix, 1000 * 1000);
}


function byte_formatter_for_bytes(c, suffix) {
    return byte_formatter_general(c, suffix, 1);
}


function byte_formatter_str(c, suffix) {
    c = parseInt(c);
    c = +c;
    c = c * 1000 * 1000;
    return byte_formatter_general_1(c, suffix, 1);
}

function byte_formatter_str_for_bytes(c, suffix) {
    c = parseInt(c);
    c = +c;
    return byte_formatter_general_1(c, suffix, 1);
}


function byte_formatter_general(c, suffix, multiplier) {
    var bytes = c.value * multiplier;
    if (bytes == 0) {
        return '0 B';
    }
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1000)));
    return Math.round(bytes / Math.pow(1000, i), 2) + ' ' + sizes[i] + suffix;
}

function byte_formatter_general_1(c, suffix, multiplier) {
    var bytes = c * multiplier;
    if (bytes == 0) {
        return '0 B';
    }
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1000)));
    return Math.round(bytes / Math.pow(1000, i), 2) + ' ' + sizes[i] + suffix;
}

function num_procs_formatter_str(c, suffix) {
    c = parseInt(c);
    var i = parseInt(Math.floor(Math.log(c) / Math.log(1000)));
    return Math.round(c / Math.pow(1000, i), 10) + ' ' + num_sizes[i] + suffix;
}


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
