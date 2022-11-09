<?php
/* $host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'palestra';
$con = mysqli_connect($host,$user,$pass) or die (mysqli_error($con));
$sel = mysqli_select_db($con ,$db) or die (mysqli_error($con)); */


$databaseHost = 'fdb30.awardspace.net'; //or localhost 127.0.0.1	fdb30.awardspace.net
$databaseName = '4206314_palestra'; // your db_name
$databaseUsername = '4206314_palestra'; // root by default for localhost 
$databasePassword = '!KxS,z5f3]66qDBi';  // by defualt empty for localhost

$con = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
?>