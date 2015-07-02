<?php
	
// start session
//session_start();

echo 'Bye';
echo '<br>';
// kill the session
session_destroy();

// redirect back to website home
header( 'Location: '. Yii::app()->getBaseUrl(true) . '/index.php/user/welcome' );
	//echo '<a href="index.php">Login</a>';

?>