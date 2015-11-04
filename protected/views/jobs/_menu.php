

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <center>
        <div class="black-link"> 
            <div style="font-size:110%; font-weight: bold;"></div> 
        </div>
    </center>
    <div id="myfilter" style=" padding-bottom: 3px;"></div>
    <?php
    $json = file_get_contents("data/categories.json");
    $cats = json_decode($json, true);
    foreach ($cats as $cat) {
        ?>


        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title filter-header">
                    <a class="collapsed btn-block non-loc-colap" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <strong><?php echo $cat["name"]; ?></strong>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div>
                        <div class="nav filters" style="margin-top:10px; margin-bottom: 10px;">
                            <?php
                            $id = $_GET['c'];
                            foreach ($cat["charts"] as $chart) {
                                $color = "white";
                                if ($id == $chart["id"]) {
                                    $color = "#F0F0F0";
                                }
                                if (isset($chart["subcats"])) {
                                    echo "<div style='margin-left:5px;'>" . $chart["title"] . "</div>";
                                    echo "<div>";
                                    foreach ($chart["subcats"] as $subchart) {
                                        if ($id == $subchart["id"]) {
                                            $color = "#F0F0F0";
                                        } else {
                                            $color = "white";
                                        }
                                        ?>
                                        <li style="padding-left: 25px; background-color:<?php echo $color; ?>">
                                            <a  href="index?c=<?php echo $subchart["id"] ?>"><?php echo $subchart["title"] ?></a>
                                        </li>
                                        <?php
                                    }
                                    echo "</div>";
                                } else {
                                    ?>
                                    <li style="background-color:<?php echo $color; ?>">
                                        <a  href="index?c=<?php echo $chart["id"] ?>"><?php echo $chart["title"] ?></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <!--    <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title filter-header">
                    <a class="collapsed btn-block non-loc-colap" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <strong>Adhoc Analysis</strong>
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <div>
                        <div class="nav filters" style="margin:12px;">
                            <li>
                                <a  href="#">My Adhoc Analysis</a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myfilter3" style="padding:10px;">
            <span class="glyphicon glyphicon-plus-sign"></span>
            <a href="#">Create New Analysis...</a>
        </div>-->
</div>




