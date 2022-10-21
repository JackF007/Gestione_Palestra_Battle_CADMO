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

       <?php

        $radice = "/ProgettoFinale_Palestra_Battle_CADMO/";
        $t = $_SERVER['REQUEST_URI'];
        $tmp = str_replace($radice, '', $t); // pagina
        if (strpos($tmp, "?day=") !== false) {
            include 'btn-modify-prenotazione.php';
        }
        ?>
   </tr>