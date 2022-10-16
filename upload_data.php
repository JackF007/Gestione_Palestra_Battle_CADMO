<?php
require_once('database.php');

if (isset($_POST['register'])) {
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $via = $_POST['via'] ?? '';
    $citta = $_POST['citta'] ?? '';
    $email = $_POST['email'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $password = $_POST['password'] ?? '';
    $ripetiPassword = $_POST['ripetiPassword'] ?? '';

    $pwdLenght = mb_strlen($password);
    //per sicurezza,non si sa mai
    if (empty($email) || empty($password)) {
        echo  'Metti almeno email e password';

        echo 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $risultato = $mysqli->query("SELECT * FROM utenti where email='$email'");// per verificare che non ci siano 2 email uguali

        $user=mysqli_fetch_array($risultato);
        
        if (isset($user)) {
            $msg = 'Email già in uso: '.$email;
        } else {
            //query su login
            $no= "'".$nome."'";
            $co= "'".$cognome."'";
            $v= "'".$via."'";
            $ci= "'".$citta."'";
            $e= "'".$email."'";
            $nu= "'".$numero."'";
            $p= "'".$password_hash."'";
    
          /*   $sql = "INSERT INTO login (idlogin,username,password,ruolo,stato) VALUES (NULL,$no,$p,'Utente',1);
                SET @last_id =26;
                INSERT into utenti (idutente,nome,cognome,citta,via,email,telefono,login_idlogin) VALUES(NULL,$no,$co,$ci,$v,$e,$nu,@last_id)";
                //da modificare dopo la scelta del ruolo */
                $sql = "INSERT INTO login (idlogin,username,password,ruolo,stato) VALUES (null,$no,$co,'Utente',1)";
               
                //da modificare dopo la scelta del ruolo
                echo "ok<br>";
                
            if ($mysqli->query($sql) === TRUE) {
                $last_id = $mysqli->insert_id;// insert_id è UNA FUNZIONE accorciata,uno dei tanti modi per fare una cossessione al database
                $sql="INSERT into utenti (idutente,nome,cognome,citta,via,email,telefono,login_idlogin) VALUES(NULL,$no,$co,$ci,$v,$e,$nu,$last_id)";  
                if ($mysqli->query($sql) === TRUE) {
                    echo "Inserimento riuscito";
                }
                else{
                    echo "Inserimento non riuscito";
                }
            }
        }
    }
        echo '<br><a href="./register.php">torna indietro</a>';
}
    
?>
