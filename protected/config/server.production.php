<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    // application components
    'components' => array(
      /*  'facebook' => array(
           'appId' => '549567871741754', // needed for JS SDK, Social Plugins and PHP SDK
            'secret' => 'c15a20dec1d41b78e9ef267814ac4c0f', // needed for the PHP SDK 
            
            
        ),*/
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=hpcviz_db',
            'username' => 'root',
            'password' => 'hello',
        ),
    ),
);