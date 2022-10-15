<?php

$databaseHost = '127.0.0.1';//or localhost
$databaseName = 'palestra'; // your db_name
$databaseUsername = 'root'; // root by default for localhost 
$databasePassword = 'root';  // by defualt empty for localhost

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
 
?>