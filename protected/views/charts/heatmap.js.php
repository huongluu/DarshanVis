<style type="text/css">
    .highcharts-tooltip>span {
        background: rgba(255,255,255,0.85);
        border: 1px solid silver;
        border-radius: 3px;
        box-shadow: 1px 1px 2px #888;
        padding: 8px;
        z-index: 2;
    }
</style>

<script type = "text/javascript" >
//    $(function() {
    $(document).ready(function() {
        /**
         * This plugin extends Highcharts in two ways:
         * - Use HTML5 canvas instead of SVG for rendering of the heatmap squares. Canvas
         *   outperforms SVG when it comes to thousands of single shapes.
         * - Add a K-D-tree to find the nearest point on mouse move. Since we no longer have SVG shapes
         *   to capture mouseovers, we need another way of detecting hover points for the tooltip.
         */
        (function(H) {
            var wrap = H.wrap,
                    seriesTypes = H.seriesTypes;

            /**
             * Get the canvas context for a series
             */
            H.Series.prototype.getContext = function() {
                var canvas;
                if (!this.ctx) {
                    canvas = document.createElement('canvas');
                    canvas.setAttribute('width', this.chart.plotWidth);
                    canvas.setAttribute('height', this.chart.plotHeight);
                    canvas.style.position = 'absolute';
                    canvas.style.left = this.group.translateX + 'px';
                    canvas.style.top = this.group.translateY + 'px';
                    canvas.style.zIndex = 0;
                    canvas.style.cursor = 'crosshair';
                    this.chart.container.appendChild(canvas);
                    if (canvas.getContext) {
                        this.ctx = canvas.getContext('2d');
                    }
                }
                return this.ctx;
            }

            /**
             * Wrap the drawPoints method to draw the points in canvas instead of the slower SVG,
             * that requires one shape each point.
             */
            H.wrap(H.seriesTypes.heatmap.prototype, 'drawPoints', function(proceed) {

                var ctx;
                if (this.chart.renderer.forExport) {
// Run SVG shapes
                    proceed.call(this);

                } else {

                    if (ctx = this.getContext()) {

// draw the columns
                        H.each(this.points, function(point) {
                            var plotY = point.plotY,
                                    shapeArgs;

                            if (plotY !== undefined && !isNaN(plotY) && point.y !== null) {
                                shapeArgs = point.shapeArgs;

                                ctx.fillStyle = point.pointAttr[''].fill;
                                ctx.fillRect(shapeArgs.x, shapeArgs.y, shapeArgs.width, shapeArgs.height);
                            }
                        });

                    } else {
                        this.chart.showLoading("Your browser doesn't support HTML5 canvas, <br>please use a modern browser");

// Uncomment this to provide low-level (slow) support in oldIE. It will cause script errors on
// charts with more than a few thousand points.
//proceed.call(this);
                    }
                }
            });
        }(Highcharts));


        var start;
        $('#chart-container').highcharts({
            data: {
                csv: document.getElementById('csv').innerHTML,
                parsed: function() {
                    start = +new Date();
                }
            },
            chart: {
                type: 'heatmap',
                margin: [60, 40, 100, 100]
            },
            title: {
                text: 'Jobs Size and I/O Throughput Distribution',
                align: 'left',
                x: 40
            },
            subtitle: {
                text: 'Colors show number of jobs',
                align: 'left',
                x: 40
            },
            tooltip: {
                backgroundColor: null,
                borderWidth: 0,
                distance: 10,
                shadow: false,
                useHTML: true,
                style: {
                    padding: 0,
                    color: 'black'
                }
            },
            xAxis: {
                title: {
                    text: 'Total Bytes'
                },
                labels: {
                    format: '{value}'
                },
                minPadding: 0,
                maxPadding: 0,
//                        startOnTick: false,
//                        endOnTick: false,
//                        tickPositions: [0, 6, 12, 18, 24],
//                        tickWidth: 1,
//                        min: 0,
//                        max: 23,
//                        reversed: true
            },
            yAxis: {
                title: {
                    text: 'I/O Throughput'
                },
                labels: {
                    format: '{value}'
                },
                minPadding: 0,
                maxPadding: 0,
//                        startOnTick: false,
//                        endOnTick: false,
//                        tickPositions: [0, 6, 12, 18, 24],
//                        tickWidth: 1,
//                        min: 0,
//                        max: 23,
//                        reversed: true
            },
            colorAxis: {
//                stops: [
//                    [0, '#99FFFF'],
//                    [10, '#0000FF'],
//                    [20, '#FFFF00'],
//                    [30, '#FF0000']
//                ],
//                type: 'logarithmic'
//                min: 0,
//                max: 50,
//                        startOnTick: false,
//                        endOnTick: false,
                labels: {
                    format: '{value}'
                }
            },
            series: [{
                    borderWidth: 0,
                    nullColor: '#EFEFEF',
//                            colsize: 24 * 36e5, // one day
                    tooltip: {
                        headerFormat: 'Job Counts<br/>',
                        pointFormat: '{point.x} {point.y}: <b>{point.value} jobs</b>'
                    },
                    turboThreshold: Number.MAX_VALUE // #3404, remove after 4.0.5 release
                }]

        });
        console.log('Rendered in ' + (new Date() - start) + ' ms');

    });
</script>