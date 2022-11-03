<?php

if ($_POST['temperatura']) {

$vartemp= ($_POST['temperatura']);

    include 'config.php';
    $sql = "UPDATE domotica SET temperatura = $vartemp WHERE iddom= 1";
    $result = mysqli_query($con, $sql);

    $data = []; // Save the data into an arbitrary array.
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data); // This will encode the data into a variable that JavaScript can decode. 
}

if ($_POST['luce']) {

    $vartemp = intval($_POST['temperatura']);
    $varluce = ($_POST['luce']);
    if ($varluce == "on") $varluce = 1;
    else $varluce = 0;
    include 'config.php';
    $sql = "UPDATE domotica SET luci = $varluce  WHERE iddom= 1";
    $result = mysqli_query($con, $sql);

    $data = []; // Save the data into an arbitrary array.
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data); // This will encode the data into a variable that JavaScript can decode. 
}
?>