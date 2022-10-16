     <tr>
         <td>
             <?php echo " Prenotazioni del <b>$data</b><br>" ?>
         </td>
         <td>
             <a>
                 <?php echo "<b>$titolo</b><br>" ?>
             </a>
             <br />
             <small>
                 Created 01.01.2019
             </small>
         </td>
         <td>
             <ul class="list-inline">
                 <li class="list-inline-item">
                     <img alt="Avatar" class="table-avatar" src="./dist/img/avatar.png">
                 </li>
             </ul>
         </td>
         <td class="project_progress">
             <div class="progress progress-sm">
                 <?php echo "<b>$testo</b><br>" ?>
             </div>
             <small>
                 57% Complete
             </small>
         </td>
         <td class="project-state">
             <span class="badge badge-success">Success</span>
         </td>
         <td class="project-actions text-right">
             <a class="btn btn-primary btn-sm" href="#">
                 <i class="fas fa-folder">
                 </i> View
             </a>
             <a class="btn btn-info btn-sm" href="#">
                 <i class="fas fa-pencil-alt">
                 </i> Edit
             </a>
             <a class="btn btn-danger btn-sm" href=" <?php echo "\cancella.php?id=$id" ?> ">
                                            <i class=" fas fa-trash">
                 </i> Delete
             </a>
         </td>
     </tr>