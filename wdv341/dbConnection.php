<?php
//PHP PDO Connection File - this needs to be in ignore file on git - do not commit
//This file is used to connect to a database
//Include this file into your application

$serverName = 	        'localhost';	  //the usual default name 	
$databaseUserName = 	'ryblank_wdv341'; //databaseUserName of the database
$databasePassword = 	'abigail7';		  //databasePassword of your database
$databaseName =         'ryblank_wdv341'; //name of the database you will be accessing

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $databaseUserName, $databasePassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>