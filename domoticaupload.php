<?php
@ob_start();
session_start();
?>
<?php
session_start();
if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 1000)) {
$_SESSION = array();
session_destroy();
header("Location:/index.php?timeout=1");
}
?>
<!DOCTYPE html>
<?php
session_start();
$session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');
if (!(isset($_SESSION['session_id']))) {
header("location:index.php");
}

$mail_log = $_SESSION['session_email'];



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



if ($_GET['id']) {

    $idcheck = intval($_GET['id']);
  
    include 'config.php';
    $sql = "UPDATE prenotazioni SET presenza = 'True'  WHERE id_prenotazione= $idcheck";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
   // echo json_encode($data); // This will encode the data into a variable that JavaScript can decode. 
}
?>