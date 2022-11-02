<?php


$conn = new mysqli("localhost","root","","palestra");

if($conn === false) {
    die("Errore di connessione: " . $conn->connect_error);
} else {

echo "Connessione effettuata con successo:" .$conn->host_info;
}

$getTimeStamp = '2013-09-26 13:06:00';
$date = new \DateTime($getTimeStamp);

/// MI RICAVO LA DATA ED ORA ATTUALE, CONNETTO AL DB E SELEZIONO LE COLONNE CHE MI SERVONO
$dateString = date('m-d-Y H:i:s');
//echo $dateString;

$inizioFascia = (int)$date->format('H');
$fineFascia = $inizioFascia ++;
$hourString = $fineFascia . '-' . $inizioFascia;
//echo $hourString;
$dateOra = date('H');
echo $dateOra;

$fineFascia = $dateOra +1;
$hourString = $dateOra. '-' .$fineFascia;
echo $hourString;

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

        
        $arrDate = array();
        $i = 0;
        while($row=$result->fetch_array()){
            echo '<tr>
            <td>' . $row['id_prenotazione']. '</td>
            <td>' . $row['data_appuntamento']. '</td>
            <td>' . $row['fascia_oraria'] . '</td>
            <td>' . $row['id_utente_prenotazione'] . '</td>
            </tr>
            ';
           
         
         
         
         
         
            $firstHour =  substr($row[2], 0, 2);
           array_push($arrDate,$firstHour);
  //         echo ($arrDate[$i]);
            $i++;
        if ($row[2] == $hourString && $row[1] == $dateString) {
                echo "Checkin effettuabile";
                    //QRCODE VALIDO E GENERABILE 

            }else if (($row[1] == $dateString && $row[2]!=$hourString) && ($arrDate[$i]>$hourString)) {
               echo "Passare al qrCode Successivo";

               //GENERARE NUOVO QRCODE 
                
            } else if (($row[1] == $dateString && $row[2]!=$hourString) && ($arrDate[$i]<$hourString)){
                echo "Checkin non effettuabile perchè in ritardo";
            };


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