<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'agenda';
$con = mysqli_connect($host,$user,$pass) or die (mysqli_error($con));
$sel = mysqli_select_db($con ,$db) or die (mysqli_error($con));
?>