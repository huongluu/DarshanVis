# DarshanVis
Darshan (A Scalable HPC I/O Characterization Tool) Data Visualization Tool

Requirement
 - Framework: PHP + Apache Server + MySQL. 
 - A MySQL functionality enhancement UDF: https://github.com/infusion/udf_infusion
   
For Windows, you can install XAMPP (https://www.apachefriends.org/index.html) that includes all the above, for OS X install MAMP (https://www.mamp.info/en/). 

Once you install MAMP/XAMPP, open it --> Preferences --> Ports --> Set Web & MySQL ports to 80 & 3306. If you use another port for Web (Apache Port & Nginx Port) then remember to put them in your link on localhost. For example: you set Apache Port & Nginx Port to 8080 then 

Instead of using: http://localhost/DarshanVis/index.php/jobs/index?c=9

Your link should be: http://localhost:8080/DarshanVis/index.php/jobs/index?c=9

 - IDE: Anything to help you code. Our suggestion: NetBeans
 
Installation
 - Clone the project on the htdocs directory (in your xampp/mamp installation): For example, if you install MAMP to /Applications you will clone the project in: /Applications/MAMP/htdocs/
 
    git clone https://github.com/Aleyasen/DarshanVis.git

 - Move htdocs/DarshanVis/yii.zip to htdocs/yii.zip.  Unzip yii.zip
 - Check http://localhost/yii/requirements/ in your browser to check that your PHP version has all requirements for Yii framework.

Access data remotely

- Edit DarshanVis/protected/config/server.production.php: 
 
```php
return array(
	// application components
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=palm.cs.illinois.edu;dbname=mira_final',
			'username' => 'huongluu',
			'password' => '******',  (we will send it to you)
		),
	),
);
```
 
 Note: you will need to be inside UIUC network to connect to this database

Access data locally: I will send you a dump file that you can import to your local MySQL server. 
First, create a new database (for example called  darshanvis_db). Then import the dump file to this new database.

- Edit DarshanVis/protected/config/server.production.php: 
 
```php
return array(
	// application components
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=darshanvis_db',
			'username' => 'your MySQL username',
			'password' => 'your MySQL password',  
		),
	),
);
```
 - Visit http://localhost/DarshanVis/index.php/jobs/index?c=9
