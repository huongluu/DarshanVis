<?php

function generic($chart, $data) {
    $result = flip($data);
    return $result;
}

function generic2($chart, $data) {
    $out = flip($data);
    $result = array();
    $result["cat"] = $out[$chart["xAxis"]["attribute"]];
    $result["series"] = $out[$chart["series"][0]["min"]];
    return $result;
}

function flip($arr) {
//    $ridx = 0;
    $out = array();
    foreach ($arr as $rowidx => $row) {
        foreach ($row as $colidx => $val) {
            if (!isset($out[$colidx])) {
                $out[$colidx] = array();
            }
            $out[$colidx][] = $val;
        }
//        $ridx++;
    }
    return $out;
}
