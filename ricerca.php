<?php

if(isset($_POST["tutte"]) ) {

    include 'inAll.php';





    //Return the data back to form.php
    //echo json_encode("ok");
}

if (isset($_POST["dataDal"]) && isset($_POST["dataAl"])) {
    $al = $_POST["dataAl"];
    $dal=$_POST["dataDal"];
 
   include 'inFilterData.php';





    //Return the data back to form.php
    //echo json_encode("ok");
}
