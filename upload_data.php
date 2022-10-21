<?php
require_once('config.php');

if (isset($_POST['register'])) {
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $dataNasciata = $_POST['data_nascita'] ?? '';
    $cf = $_POST['CF'] ?? '';
    $email = $_POST['email'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $password = $_POST['password'] ?? '';
    $ruolo = $_POST['ruolo'] ?? '';


    $pwdLenght = mb_strlen($password);
    //per sicurezza,non si sa mai
    if (empty($email) || empty($password)) {
        //hearder register
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $risultato = $con->query("SELECT email FROM login where email='$email'"); // per verificare che non ci siano 2 email uguali

        $user = mysqli_fetch_array($risultato);

        if (isset($user)) {
            echo 'Email già in uso: ' . $email; // header con errore duplicate email
        } else {
            //query su login
            $no = "'" . $nome . "'";
            $co = "'" . $cognome . "'";
            $dn = "'" . $dataNasciata . "'";

            $cf = "'" . $cf . "'";
            $e = "'" . $email . "'";
            $nu = "'" . $numero . "'";
            $p = "'" . $password_hash . "'";
            $r = "'" . $ruolo . "'";

            $sql = "INSERT INTO login (login_id,email,password,ruolo,stato) VALUES (null,$e,$p,$r,true)";


            if ($con->query($sql) === TRUE) {
                $last_id = $con->insert_id; // insert_id è UNA FUNZIONE accorciata,uno dei tanti modi per fare una cossessione al database


                $sql = "INSERT into utenti (id_utente,nome,cognome,login_id,numero_telefono,data_nascita,CF) VALUES(null,$no,$co,$last_id,$nu,$dn,$cf)";
                if ($con->query($sql) === TRUE) {
                    echo "Inserimento riuscito";
                    echo $dn;
                } else {
                    echo "Inserimento non riuscito";
                    echo $dn;
                }
            }
        }
    }
    echo '<br><a href="./register.php">torna indietro</a>';
}
