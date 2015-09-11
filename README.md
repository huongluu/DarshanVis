# DarshanVis
Darshan (A Scalable HPC I/O Characterization Tool) Data Visualization Tool

Requirement
 - Framework: PHP + Apache Server + MySQL. 
   
For Windows, you can install XAMPP (https://www.apachefriends.org/index.html) that includes all the above, for OS X install MAMP (https://www.mamp.info/en/). 

Once you install MAMP/XAMPP, open it --> Preferences --> Ports --> Set Web & MySQL ports to 80 & 3306. If you use another port for Web (Apache Port & Nginx Port) then remember to put them in your link on localhost. For example: you set Apache Port & Nginx Port to 8080 then 

Instead of using: http://localhost/DarshanVis/index.php/jobs/index?c=9

Your link should be: http://localhost:8080/DarshanVis/index.php/jobs/index?c=9

 - IDE: suggestion: NetBeans
 
Installation
 - Clone the project on the htdocs directory (in your xampp/mamp installation): For example, if you install MAMP to /Applications you will clone the project in: /Applications/MAMP/htdocs/
 
    git clone https://github.com/Aleyasen/DarshanVis.git

 - Move htdocs/DarshanVis/yii.zip to htdocs/yii.zip.  Unzip yii.zip
 - Check http://localhost/yii/requirements/ in your browser to check that your PHP version has all requirements for Yii framework.
 - Edit DarshanVis/protected/config/server.production.php: 
 
```php
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
```
 
 Note: you will need to be inside UIUC network to connect to this database

 - Visit http://localhost/DarshanVis/index.php/jobs/index?c=9
