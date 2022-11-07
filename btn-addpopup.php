 <?php  

 if (intval($numrow) >= 8) { 
echo "<button name=\"invia-prenotazione\" type=\"submit\" class=\"btn btn-outline-light w-100\" value=\"invia-prenotazione\"disabled>Registra Prenotazione</button>"; 
 }elseif (intval($numrow) < 8) { 
echo "<button name=\"invia-prenotazione\" type=\"submit\" class=\"btn btn-outline-light w-100\" value=\"invia-prenotazione\" >Registra Prenotazione</button>";
 }
 ?>