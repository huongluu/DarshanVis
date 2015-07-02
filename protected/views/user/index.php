<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-3 sidebar">
            <?php
            include '_filters.php';
            ?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 main">
            <?php
            include '_posts.php';
            ?>
        </div>  
    </div>
</div>

<?php

function trunct($string) {
    $length = 300;
    $dots = "...";
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}

function randStr() {
    $valid_chars = 'abcdefgihjklmnop';
    $length = 8;
    // start with an empty random string
    $random_string = "";

    // count the number of chars in the valid chars string so we know how many choices we have
    $num_valid_chars = strlen($valid_chars);

    // repeat the steps until we've created a string of the right length
    for ($i = 0; $i < $length; $i++) {
        // pick a random number from 1 up to the number of valid chars
        $random_pick = mt_rand(1, $num_valid_chars);

        // take the random character out of the string of valid chars
        // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
        $random_char = $valid_chars[$random_pick - 1];

        // add the randomly-chosen char onto the end of our string so far
        $random_string .= $random_char;
    }

    // return our finished random string
    return $random_string;
}

?>