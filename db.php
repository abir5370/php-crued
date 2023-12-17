<?php 
 $dbHost = 'Localhost';
 $dbUser = 'root';
 $dbPassword = '';
 $dbName = 'php_crued';

 $dbConn = mysqli_connect($dbHost, $dbUser,$dbPassword,$dbName);
 if(!$dbConn){
    die("database can not connected");
 }

?>