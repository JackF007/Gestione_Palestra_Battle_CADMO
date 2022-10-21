<?php
session_start();
require_once('config.php');

if (isset($_SESSION['session_id'])) {
    $ruolo = $_SESSION['session_ruolo'];

    if ($ruolo == "amministrazione") {
        header('Location: dashboard.php');
    } else {
        header('Location: profile.php');
    }
    exit;
}

if (isset($_POST['login'])) { // login è il nome del bottone

    $ip = $_SERVER['REMOTE_ADDR'];
    $nomesessione = "loginIp";
    $email = $_POST['mail'];
    $password = $_POST['pass'];

    if (empty($email) || empty($password)) {

        echo "mail o pass vuoti";
    } else {
        $e = "'" . $email . "'";
        $risultato = $con->query("SELECT password , ruolo FROM login where email=$e and stato=1"); //cerca soltanto il email utente per poi controllare la password
        // se risultato ha valore mail in db
        if (mysqli_num_rows($risultato) > 0) {
            print_r($risultato);
            $result = mysqli_fetch_assoc($risultato);
            $verify = "";
            if (count($result) > 0) { // mail presente verifica pass
                if (password_verify($password,  $result["password"])) { //"password" è la colonna che c'è sul database
                    $verify = "verificato";
                } else {
                    header('Location: ./login.php?errpass=1'); //REINDIRIZZA COME SE FOSSE UN LINK
                }
            }

            if ($verify == "verificato") {
                $ruolo = $result["ruolo"];
                session_regenerate_id();
                $_SESSION['session_id'] = session_id();
                $_SESSION['session_email'] = $email;
                $_SESSION['session_ruolo'] = $ruolo;
                $_SESSION['data'] = time();
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

                if ($ruolo == "amministrazione") {
                    header('Location: dashboard.php');
                } else {
                    header('Location: profile.php');
                }
                exit;
            }
        } else {
            header('Location: ./login.php?errmail=1'); //REINDIRIZZA COME SE FOSSE UN LINK
        }
    }
} else {
    header('Location: login.php');
}
