     <tr>
         <td>
             <?php echo " Prenotazioni del <b>$data</b><br>" ?>
         </td>
         <td>
             <a>
                 <?php echo " n° <b>" . $idprenot . "</b><br>" ?>
             </a>
         </td>
         <td>
             <ul class="list-inline">
                 <li class="list-inline-item">
                     <img alt="Avatar" class="table-avatar" src="./dist/img/avatar.png">
                 </li>
                 <li> 
                     <?php echo "$utenteN</b><br>" ?>
                     <?php echo "$utenteC</b>" ?>
                     
                 </li>
             </ul>
         </td>
         <td class="project_progress">
             
                 <?php echo "fascia <b>$fascia</b><br>" ?>
             
             <small>
                 <?php echo "attività <b>$attivita</b><br>" ?>
             </small>
         </td>
         <td class="project-state">
             <span class="badge badge-success">prenotato</span>
         </td>
         <td class="project-actions text-right">
             <a class="btn btn-primary btn-sm" href="#">
                 <i class="fas fa-folder">
                 </i> View
             </a>
             <a class="btn btn-info btn-sm" href="<?php echo "./modprenotazioni.php?id=$id" ?>">
                 <i class="fas fa-pencil-alt"> </i> Modifica
             </a>
             <a class="btn btn-danger btn-sm" href=" <?php echo "./delprenotazioni.php?id=$id" ?> ">
                 <i class=" fas fa-trash">
                 </i> Delete
             </a>
         </td>
     </tr>