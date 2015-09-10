<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../yii/framework/yii.php';
// $config=dirname(__FILE__).'/protected/config/main.php';
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

// require_once($yii);
// Yii::createWebApplication($config)->run();
/////////////////////////////////////////////////
// Set configurations based on environment
if (isset($_SERVER['WINDIR'])) { // OS is windows
    // Enable debug mode for development environment
    //defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
    // Specify how many levels of call stack should be shown in each log message
    //defined( 'YII_TRACE_LEVEL' ) or define( 'YII_TRACE_LEVEL', 3 );
    // Set environment variable
    $environment = 'development';
    // $environment = $_SERVER['APPLICATION_ENV']; // Uncomment for dynamic config files
} else {
    // Set environment variable
    $environment = 'production';
}

// SET environment to production, don't use development 
$environment = 'production';
// Include config files
$configMain = require_once( dirname(__FILE__) . '/protected/config/main.php' );
$configServer = require_once( dirname(__FILE__) . '/protected/config/server.'
        . $environment . '.php' );

// Include Yii framework
require_once( $yii );





ini_set('max_execution_time', 3600);
ini_set('memory_limit', '-1');
// Run application
$config = CMap::mergeArray($configMain, $configServer);
date_default_timezone_set('America/Chicago');
session_start();
Yii::createWebApplication($config)->run();
