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


if (!(isset($_POST['id_canc_prenotazione']))) {
    header("location:dashboard.php");
}


if (!(isset($_SESSION['session_id']))) {
    header("location:index.php");
} else if ("amministrazione" != $session_ruolo) {
    header("location:profiloutente.php");
} else {

    require_once('config.php');
    $id_canc_prenotazione = intval($_POST['id_canc_prenotazione']);

    $sql = "UPDATE prenotazioni SET stato_prenotazione = 'cancellata' WHERE id_prenotazione = '$id_canc_prenotazione'";

    if ($con->query($sql) === TRUE) {
        $con->close();
        $data = $_POST['data_prenotazione'];
        $url = "Location: prenotazioni.php?day=$data&cancellato=1";
        $url2 = "Location: prenotazioni.php?day=$data&cancellato=0";
        header($url);
    } else {
        $con->close();
        header($url2);
    }
}


?>
