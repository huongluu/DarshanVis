# DarshanVis
Darshan (A Scalable HPC I/O Characterization Tool) Data Visualization Tool


Requirement
 - Framework: PHP + Apache Server + MySQL. 
   For Windows, you can install XAMPP (https://www.apachefriends.org/index.html) that includes all the above, for OS X install MAMP (https://www.mamp.info/en/)
 - IDE: suggestion: NetBeans
 
Installation
 - Clone the project on the htdocs directory (in your xampp/mamp installation):  git clone https://github.com/Aleyasen/DarshanVis.git
 - Move htdocs/DarshanVis/yii.zip to htdocs/yii.zip.  Unzip yii.zip
 - Check http://localhost/yii/requirements/ in your browser to check that your PHP version has all requirements for Yii framework.
 - Edit server.production.php: 
 <?php
return array(
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=palm.cs.illinois.edu;dbname=mira_final',
            'username' => 'intern',
            'password' => '******',  (we will send it to you)
        ),
    ),
);
 Note: you will need to be inside UIUC network to connect to this database

 - Visit http://localhost/DarshanVis/index.php/jobs/index?c=9
