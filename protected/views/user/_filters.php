

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <center>
        <div class="black-link"> 
            <a href="https://facebook.com/aleyasin">
                <img class="img-circle" width="50px" src="http://graph.facebook.com/aleyasin/picture?type=large">
            </a>
            <div style="font-size:110%; font-weight: bold;">Amirhossein Aleyasen</div> 
        </div>
    </center>
    <div id="myfilter" style=" padding-bottom: 3px;"></div>

    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title filter-header">
                <a class="collapsed btn-block non-loc-colap" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <strong>Favorite Feeds</strong>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div>
                    <div class="nav filters" style="margin:12px;">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $favFilter,
                            'itemView' => '_filterview',
                            'template' => '{items}',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title filter-header">
                <a class="collapsed btn-block non-loc-colap" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <strong>Recent Feeds</strong>
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <div>
                    <div class="nav filters" style="margin:12px;">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $recentFilter,
                            'itemView' => '_filterview',
                            'template' => '{items}',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title filter-header">
                <a class="collapsed btn-block non-loc-colap" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <strong>More</strong>
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                <div>
                    <div class="nav filters" style="margin:12px;">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $otherFilter,
                            'itemView' => '_filterview',
                            'template' => '{items}',
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myfilter3" style="padding:10px;">
        <span class="glyphicon glyphicon-plus-sign"></span>
        <a href="http://localhost:8080/dreamfeed/index.php/user/add/159">Create New Feed...</a>
    </div>
</div>




