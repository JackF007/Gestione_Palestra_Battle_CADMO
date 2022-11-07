<form action='addprenotazione.php' method='post'>
  <input name='day' type='hidden' value=<?php echo $day ?>>
  <input name='fascia' type='hidden' value='<?php echo $orari ?>'>
  <button type='submit' class=" w-100 btn btn-primary " value='Invia' role="button" aria-pressed="true"><i class="fas fa-plus"></i>Nuova Prenotazione</button>

</form>