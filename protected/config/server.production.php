<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    // application components
    'components' => array(
        'db' => array(

            // 'connectionString' => 'mysql:host=localhost;dbname=pt_db',
            // 'username' => 'root',
            // 'password' => '123456789',

           'connectionString' => 'mysql:host=127.0.0.1;dbname=hpcviz_db',
           'username' => 'root',
           'password' => '',
           'connectionString' => 'mysql:host=palm.cs.illinois.edu;dbname=mira_2015',

        ),
    ),
);
