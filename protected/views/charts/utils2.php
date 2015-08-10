<?php

function getHighchartSafeJson($arr) {
    $json = json_encode($arr);
    $json = substr($json, 1, strlen($json) - 2) . ",";
    return $json;
}

function nullSafe($val) {
    if (isset($val)) {
        return $val;
    } else {
        return "";
    }
}

?>
