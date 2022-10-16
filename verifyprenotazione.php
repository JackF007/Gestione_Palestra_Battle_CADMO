
<?php


////////
if (isset($_POST['invia-prenotazione'])) { //vengo da controllo

    echo '<pre>';
    echo ($_POST['time-data']);
    echo '</pre>';
    $day = ($_POST['time-data']);

    include 'config.php';

    $sql = "SELECT COUNT(*) FROM appuntamenti WHERE dataAppuntamento=\"$day\""; //count su
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo $row[0];
        if ($row[0] < 8) {
/*             $sql = "insert =\"$day\""; //count su 
           $result = mysqli_query($con, $sql) or die(mysqli_error($con));

          header("location:login.php"); */
// fai querY insert
        }
    }
} 

?>




