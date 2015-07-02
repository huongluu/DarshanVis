
<div id="sorts" class="button-group pull-right" style="margin-right:85px;">
    <button class="button is-checked" data-sort-by="date">date</button>
    <button class="button" data-sort-by="sender">sender</button>
    <button class="button" data-sort-by="type">type</button>
    <button class="button" data-sort-by="length">length</button>
</div>
<br><br>
<center>
    <div id="myfilter2"></div>
</center>
<br>
<div class="isotope">

    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $allPosts,
        'itemView' => '_fbview',
        'template' => '{items}',
    ));
    ?>
    <!--    <div class="item element-item alkali metal " data-category="alkali" style="position: absolute; left: 440px; top: 0px;">
            <h5 class="name">Potassium</h5>
            <p class="symbol">K</p>
            <p class="number">19</p>
            <p class="weight">39.0983</p>
        </div>-->
</div>