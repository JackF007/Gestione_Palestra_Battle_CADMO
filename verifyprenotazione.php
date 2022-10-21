<?php
session_start();
if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 500)) {
    $_SESSION = array();
    session_destroy();
    header("Location: ./login.php?timeout=1");
}
$session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');
if (!(isset($_SESSION['session_id'])) || (isset($_SESSION['session_id']))) {

    header("location:login.php");
}

if (isset($_POST['invia-prenotazione'])) { //vengo da controllo
    var_dump($_POST);
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    require_once('config.php');

    $idutente = $_POST['id_cliente'] ?? '';
    $str_data = $_POST['str_data'] ?? '';
    $dataprenotazione = $_POST['data_prenotazione'] ?? '';
    $fascia = $_POST['fascia_prenotazione'] ?? '';
    $attivita = $_POST['attivita_prenotazioneForm'] ?? '';

    $idutente =  intval($idutente);
    $dataprenotazione = "'" . $dataprenotazione . "'";
    $str_data = intval($str_data);
    $fascia = "'" . $fascia . "'";
    $attivita = 1;


    $sql = "INSERT INTO prenotazioni (id_prenotazione, data_effettuazione, str_data, data_appuntamento, fascia_oraria, id_utente_prenotazione, tipo_attivita, stato_prenotazione, presenza) VALUES (null,CURRENT_TIMESTAMP(),$str_data,$dataprenotazione,$fascia,$idutente,1,1,1)";


    if ($con->query($sql) === TRUE) {
        if ($session_ruolo == "amministrazione") {
            header('Location: dashboard.php?prenotato=1');
        } else {
            header('Location: profile.php?prenotato=1');
        }
    } else {
        if ($session_ruolo == "amministrazione") {
            header('Location: dashboard.php?nonprenotato=1');
        } else {
            header('Location: profile.php?nonprenotato=1');
        }
    }
}
