<?php
session_start();
if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 500)) {
    $_SESSION = array();
    session_destroy();
    header("Location: ./login.php?timeout=1");
}
$session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');

if (!(isset($_SESSION['session_id']))) {
    header("location:login.php");
}




if (isset($_POST['mod-prenotazione'])) { //vengo da controllo
   

    require_once('config.php');
    $str_data = $_POST['str_data'] ?? '';
    $idutente = $_POST['id_cliente'] ?? '';
    $idprenotazione = $_POST['id_prenotazioneForm'] ?? '';
    $fascia = $_POST['fascia_prenotazione'] ?? '';
    $attivita = $_POST['attivita_prenotazioneForm'] ?? '';
    
    $str_data =intval($str_data);;
    $idutente =  intval($idutente);
    $idprenotazione =  intval($idprenotazione);
    $fascia = "'" . $fascia . "'";
    $attivita = 1;
    $url = "Location: prenotazioni.php?day=$str_data&modificato=1";
    $url2 = "Location: profiloutente.php?day=$str_data&modificato=1";
    $url3 = "Location: prenotazioni.php?day=$str_data&modificato=0";
    $url4 = "Location: profiloutente.php?day=$str_data&modificato=0";
     $sql = "UPDATE prenotazioni SET data_effettuazione = CURRENT_TIMESTAMP() , fascia_oraria = $fascia, id_utente_prenotazione = '$idutente', stato_prenotazione = '2' WHERE id_prenotazione = '$idprenotazione'";


  if ($con->query($sql) === TRUE) {
        if ($session_ruolo == "amministrazione") {
            $con->close();
            header($url);
            
        } else { 
            $con->close();
            header($url2);;
        }
    } else {
        if ($session_ruolo == "amministrazione") {
            $con->close();
            header($url3);
            
        } else {
            $con->close();
            header($url4);
            
        }
    }  
    $con->close();
}


if (isset($_POST)) { //vengo da controllo
echo " <pre>";
var_dump($_POST);
    echo " </pre>";

  /*  require_once('config.php');

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
    $url = "Location: prenotazioni.php?day=$str_data&prenotato=1";
    $url2 = "Location: profiloutente.php?day=$str_data&prenotato=1";
    $url3 = "Location: prenotazioni.php?day=$str_data&prenotato=0";
    $url4 = "Location: profiloutente.php?day=$str_data&prenotato=0";
 
    $sql = "INSERT INTO prenotazioni (id_prenotazione, data_effettuazione, str_data, data_appuntamento, fascia_oraria, id_utente_prenotazione, tipo_attivita, stato_prenotazione, presenza) VALUES (null,CURRENT_TIMESTAMP(),$str_data,$dataprenotazione,$fascia,$idutente,1,1,1)";


    if ($con->query($sql) === TRUE
    ) {
        if ($session_ruolo == "amministrazione") {
            $con->close();
            header($url);
        } else {
            $con->close();
            header($url2);
        }
    } else {
        if ($session_ruolo == "amministrazione") {
            $con->close();
            header($url3);
        } else {
            $con->close();
            header($url4);
        }
    }
    $con->close();*/
}