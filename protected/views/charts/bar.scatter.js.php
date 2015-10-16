<?php
include_once 'utils2.php';
/ include_once 'utils2.php';

$data = Jobs::execSQLQuery($chart["series"][0]["query"]);

// $series1_str = "";
// $series2_str = "";
// $series_str = "";
//
// $index = 1;
// foreach ($data as $d) {
//     $series1_str .= '[' . $index . ',' . $d[$chart["series"][0]["series1"]] . '],';
//     $series2_str .= '[' . $index . ',' . $d[$chart["series"][0]["series2"]] . '],';
//     $series_str .= '[' . $d[$chart["series"][0]["series1"]] . ',' . $d[$chart["series"][0]["series2"]] . '],';
//     $index++;
// }
//
// $x_options = $chart["yAxis"]["options"];
// $y_options = $chart["yAxis"]["options"];
//
// $x_options_list = "";
// $y_options_list = "";
//
// foreach ($x_options as $str)
// {
//   $x_options_list .= "<option value=" . $str . ">" . $str . "</option>";
// }
// foreach ($y_options as $str)
// {
//   $y_options_list .= "<option value=" . $str . ">" . $str . "</option>";
// }
//
// // create json array with each option and its data set
//
//
// $ret = array();
//
// foreach($x_options as $str)
// {
//   $series = "";
//   foreach ($data as $d)
//   {
//     $series .= $d[$str] . ',';
//   }
//   $ret[$str] = $series;
// }
//
// $json_str = json_encode($ret);
//
//
// $series1_str = rtrim($series1_str, ",");
// $series2_str = rtrim($series2_str, ",");
// $series_str = rtrim($series_str, ",");
?>
<script type="text/javascript">
$(function(){
  console.log(<?php echo $data?>);
});
</script>
