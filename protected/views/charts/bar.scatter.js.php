<?php
include_once 'utils2.php';
?>
<script type="text/javascript">

$(function () {
  $('#tooltip1').tooltip({
    title:
    'Non-global data I/O: The amount of time this job spent in function calls to read/write its files not accessed by all processes.'
  });
  $('#tooltip2').tooltip({
    title:
    'Non-global Metadata: The amount of time this job spent in metadata function calls (open, close, seek, etc.) for non-global files, i.e., files that one or more but not all processes opened.'
  });
  $('#tooltip3').tooltip({
    title:
    'Global data I/O: The amount of time this job spent in function calls to read/write global files, i.e., files that all processes opened.'
  });
  $('#tooltip4').tooltip({
    title:
    'Global Metadata: The amount of time this job spent in metadata function calls (open, close, seek, etc.) for global files, i.e., files that all processes opened.'
  });
  $('#tooltip5').tooltip({
    title:
    'Not I/O: The amount of time this job spent outside of I/O function calls (data and metadata).'
  });
  $('#tooltip6').tooltip({
    title:
    '# of Processes: The number of processes this job had.'
  });
  $('#tooltip7').tooltip({
    title:
    'Total Bytes Read/Written: The total number of bytes this job read and wrote.'
  });
  //        $("#tooltip1").tooltip('show');
  //        $('[data-toggle="tooltip"]').tooltip();
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
    });
  }

  // Add `globalCallback` to the list of highcharts callbacks
  Highcharts.Chart.prototype.callbacks.push(globalCallback);
  console.log($('#chart-container'));
  $('#chart-container').highcharts({
    <?php echo getHighchartSafeJson($chart["highchart-confs"]); ?>

    series: []
  });

  var chart = $('#chart-container').highcharts();
  var color = false;
  var stacking = false;
  console.log(">>>>>>>>>>>");
  console.log(chart);


  // Toggle abs/%
  $('#toggle-percentage').click(function () {

    for (var i = 0; i < 5; i++) {
      chart.series[i].update({
        stacking: stacking ? "normal" : "percent"
      });
    }

    //            chart.yAxis[0].labels.update({
    //                format: stacking ? "{value}" : "{value}%"
    //            });

    chart.yAxis[0].axisTitle.attr({
      text: stacking ? "Distribution of time (s)" : "Percentage of time (%)"
    });
    if (!stacking) {
      chart.yAxis[0].setExtremes(0, 100);
    } else {
      chart.yAxis[0].setExtremes(null, null);
    }
    stacking = !stacking;
    //            chart.series[0].update({
    //                color: color ? null : Highcharts.getOptions().colors[1]
    //            });
    //            color = !color;





  });

});
</script>
