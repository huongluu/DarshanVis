# DarshanVis
Darshan (A Scalable HPC I/O Characterization Tool) Data Visualization Tool


Requirement
 - PHP
 - Apache Server
 - MySQL
 For Windows, you can install XAMPP (https://www.apachefriends.org/index.html) that includes all the above, for OS X install MAMP (https://www.mamp.info/en/)

Installation
 - Clone the project on the htdocs directory (in your xampp/mamp installation).
 - Move htdocs/DarshanVis/yii.zip to htdocs/yii.zip
 - Unzip yii.zip
 - Check http://localhost/yii/requirements/ in your browser to check that your PHP version has all requirements for Yii framework.
 - Using PhpMyAdmin (http://localhost/phpmyadmin/) or your MySQL client, create a new database. Pick hpcviz_db as the name.
 - Import the SQL dump file to the created database.
 - Visit http://localhost/DarshanVis/index.php/jobs/index?c=2
