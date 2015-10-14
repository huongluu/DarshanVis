<?php
// WARNING: DON'T USE THIS CONFIGURATION FILE. PLEASE USE server.production.php INSTEAD.
// 
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=172.22.165.28;dbname=mira_2015',
            'username' => 'root',
            'password' => 'Hello123',
        // Enable profiling
        // 'enableProfiling' => true,
        // 'enableParamLogging' => true,
        ),
    ),
);
