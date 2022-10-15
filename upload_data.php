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
    //$isUsernameValid = filter_var($username,FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-z\d_]{3,20}$/i"]]);
    $pwdLenght = mb_strlen($password);
    
    if (empty($email) || empty($password)) {
        echo  'Metti almeno email e password';
    // } elseif (false === $isUsernameValid) {
    //     echo 'Lo username non è valido. Sono ammessi solamente caratteri 
    //             alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
    //             Lunghezza massima 20 caratteri';
    // } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        echo 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $risultato = $mysqli->query("SELECT * FROM utenti where email='$email'");

        $user=mysqli_fetch_array($risultato);
        
        if (isset($user)) {
            $msg = 'Email già in uso: '.$email;
        } else {
            $no= "'".$nome."'";
            $co= "'".$cognome."'";
            $v= "'".$via."'";
            $ci= "'".$citta."'";
            $e= "'".$email."'";
            $nu= "'".$numero."'";
            $p= "'".$password_hash."'";
            $sql = "INSERT INTO utenti (idutente,nome,cognome,via,citta,email,telefono,password,login_idlogin) VALUES (null,$no,$co,$v,$ci,$e,$nu,$p,null)";

            if (mysqli_query($mysqli, $sql)) {
            echo "Record caricato"."<br>"; $msg = 'Registrazione eseguita con successo';
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
            $msg = 'Problemi con l\'inserimento dei dati %s';
            }

            mysqli_close($mysqli);        
        } 
        echo $msg."<br>";
        echo '<a href="./register.html">torna indietro</a>';
    }
    
  
}