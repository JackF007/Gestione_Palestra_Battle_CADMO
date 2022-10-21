<td class="project-actions text-right">
  <a class="btn btn-primary btn-sm" href="#">
    <i class="fas fa-folder">
    </i> View
  </a>
  <a class="btn btn-info btn-sm" href="<?php echo "./modprenotazioni.php?id=$idprenot" ?>">
    <i class="fas fa-pencil-alt"> </i> Modifica
  </a>

  <button id="$idprenot_button" onclick="deleteprnotazione()" value="<?php echo $idprenot ?>" type="button" class=" btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-danger">
    <i class=" fas fa-trash">
    </i> Delete
  </button>
</td>