<?php
/* $host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'palestra';
$con = mysqli_connect($host,$user,$pass) or die (mysqli_error($con));
$sel = mysqli_select_db($con ,$db) or die (mysqli_error($con)); */


$databaseHost = '127.0.0.1'; //or localhost
$databaseName = 'palestra'; // your db_name
$databaseUsername = 'root'; // root by default for localhost 
$databasePassword = 'root';  // by defualt empty for localhost

$con = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
?>