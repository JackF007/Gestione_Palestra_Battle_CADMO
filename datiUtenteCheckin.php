<?php


$conn = mysqli_connect("localhost","root","","palestra");

if($conn === false) {
    die("Errore di connessione: " .$con->connect_error);
} 

echo "Connessione avvenuta con successo:" .$conn->host_info;

$getTimeStamp = '2013-09-26 13:06:00';
$date = new \DateTime($getTimeStamp);

/// MI RICAVO LA DATA ED ORA ATTUALE, CONNETTO AL DB E SELEZIONO LE COLONNE CHE MI SERVONO

$dateString = $date->format('Y-m-d');
$hourString = $date->format('H');
$minuteString = $date->format('i');


$sql = "SELECT id_prenotazione,data_appuntamento,fascia_oraria,id_utente_prenotazione FROM prenotazioni";
if($result = $conn->query($sql)){
    if($result->num_rows>0){
        echo '<table>
        <tr>
        <th>id_prenotazione</th>
        <th>data_appuntamento</th>
        <th>fascia_oraria</th>
        <th>id_utente_prenotazione</th> 
        </tr>';
        
        while($row=$result->fetch_array()){
            echo '<tr>
            <td>' . $row['id_prenotazione']. '</td>
            <td>' . $row['data_appuntamento']. '</td>
            <td>' . $row['fascia_oraria'] . '</td>
            <td>' . $row['id_utente_prenotazione'] . '</td>
            </tr>
            ';
        }
 
        /*check: VERIFICARE ORA E DATA APPUNTAMENTO RISPETTO AD ADESSO 
        if((in_array($hourString,$row['fascia_oraria'])) && $dateString=$row['data_appuntamento']){


        };*/

        echo "</table>";

    }else {

        echo "Non ci sono righe per questa query";
    }
} else {
    echo "Impossibile eseguire la query $sql. " .$conn->error;
}
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));





$conn->close();