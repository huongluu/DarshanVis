<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    // application components
    'components' => array(
      /*  'facebook' => array(
            
           // 'appId' => '326556410807158', // needed for JS SDK, Social Plugins and PHP SDK
           // 'secret' => '44a76fb2b2c907e2d3fcc2303fe4bacd', // needed for the PHP SDK 
            
            'appId' => '549567871741754', // needed for JS SDK, Social Plugins and PHP SDK
            'secret' => 'c15a20dec1d41b78e9ef267814ac4c0f', // needed for the PHP SDK 
           
        ),*/
        'db' => array(
            'connectionString' => 'mysql:host=172.22.165.28;dbname=mira_final',
            'username' => 'root',
            'password' => 'Hello123',
        // Enable profiling
        // 'enableProfiling' => true,
        // 'enableParamLogging' => true,
        ),
    ),
);
