<?php

function getChartInfo($id) {
    $charts = array();
    $charts_dir = "data/charts/";
    $files = scandir($charts_dir);
    foreach ($files as $f) 
    {
        if ($f == "." || $f == "..")
        {
            continue;
        }

        $json = file_get_contents($charts_dir . $f);
        $chart_data = json_decode($json, true);
        //var_dump($chart_data);
        //echo "!!!!!!!!!!!!!!!!!\n";

        $charts[] = $chart_data;
        //var_dump($charts);
    }


    foreach ($charts as $c) {
        if ($c["id"] == 1) {
            $generic_chart = $c;
            break;
        }
    }
    foreach ($charts as $c) {
        if ($c["id"] == $id) {
            $main_chart = $c;
            break;
        }
    }
    $chart = array_replace_recursive($generic_chart, $main_chart);
    //var_dump($chart);
    return $chart;
}

