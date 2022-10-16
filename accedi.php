<?php

session_start();
require_once('database.php');

if (isset($_SESSION['session_id'])) {
    header('Location: dashboard.html');//REINDIRIZZA COME SE FOSSE UN LINK
    exit;//è come break dopo chen cambia pagina
}

if (isset($_POST['login'])) {// login è il nome del bottone
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $msg = 'Inserisci username e password %s';
    } else {
        $risultato = $mysqli->query("SELECT password FROM users where username='$username'");//cerca soltanto il nome utente per poi controllare la password

        $result = mysqli_fetch_assoc($risultato);
     
        $verify="";
    if ($result>0) {
        if (password_verify($password,  $result["password"])) {//"password" è la colonna che c'è sul database
            $verify = "verificato";
        } else {
            header('Location: ./accedi.php?credenziali_errate');//REINDIRIZZA COME SE FOSSE UN LINK
        }   
    }
       
        if ($verify=="verificato") {//utilizza un vettore associativo
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $username;
            $_SESSION['data'] = time();
            header('Location: dashboard.php');//REINDIRIZZA COME SE FOSSE UN LINK
            exit;
        } else {
            header('Location: ./accedi.php?credenziali_errate');//REINDIRIZZA COME SE FOSSE UN LINK
        }
    }
}

