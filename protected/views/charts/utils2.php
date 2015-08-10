<?php

function getHighchartSafeJson($arr) {
    $json = json_encode($arr);
    $json = substr($json, 1, strlen($json) - 2) . ",";
    return $json;
}

?>
