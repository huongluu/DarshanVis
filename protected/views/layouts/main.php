<!DOCTYPE html>
<html>
    <head>

        <title>DarshanVis: Visualization for High Performance Computing I/O</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Dreamfeed">
        <meta name="keyword" content="Dreamfeed">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dc.css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.nouislider.min.css">   
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/extra.css"> 
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-tour-standalone.min.css"> 
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/hpcviz.css"> 

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.js"></script>


        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script> <!-- Modernizr -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.nouislider.all.js"></script> <!-- Slider -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-tour-standalone.min.js"></script> <!-- Slider -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts/highcharts.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts/highcharts-3d.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts/highcharts-more.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts/modules/exporting.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts/modules/data.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts/modules/heatmap.js"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.8.1/bootstrap-table-all.min.js"></script>-->
<!--<script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>-->
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/2.9.0/moment.min.js"></script>
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker-bs3.css" />
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-select.min.js" type="text/javascript"></script>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dv/utils.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dv/sorting.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dv/filtering.js"></script> 
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dv/main.js"></script> 
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dv/table.js"></script> 

    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><b>DarshanVis</b></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                    <!--                    <form class="navbar-form navbar-right">
                                            <input size="100" type="text" class="form-control" placeholder="Search...">
                                        </form>-->
                </div>
            </div>
        </nav>

        <?php echo $content; ?>




        <?php include '_jscharts.php'; ?>
        <?php include '_otherjs.php'; ?>

    </body>
</html>