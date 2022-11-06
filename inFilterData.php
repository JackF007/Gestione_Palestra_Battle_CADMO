  <table id="example1" class="table table-bordered table-striped">

      <thead>
          <tr>
              <th>id</th>
              <th>data prenotazione</th>
              <th>data appuntamento</th>
              <th>fascia_oraria</th>
              <th>tipo attivita</th>
              <th>stato prenotazione</th>
              <th>check in</th>
              <th>Utente</th>
          </tr>
      </thead>
      <tbody>
          <?php

            $listaggData = [];
            $listgraph = [];
            include 'config.php';
            $risultato = $con->query("SELECT p.id_prenotazione, DATE_FORMAT(p.data_effettuazione,\"%d-%m-%Y\") , DATE_FORMAT(p.data_appuntamento,\"%d-%m-%Y\"), p.fascia_oraria, a.nome_attivita  , p.stato_prenotazione,p.presenza, p.id_utente_prenotazione,  u.nome , u.cognome , p.str_data FROM prenotazioni as p join utenti as u on u.id_utente = p.id_utente_prenotazione join login as l on l.login_id = u.login_id  join attivita as a on p.tipo_attivita = a.id_attivita WHERE p.str_data>1 and l.stato>0 And p.data_appuntamento>='$dal' And p.data_appuntamento<='$al' order by p.data_appuntamento desc ");

            while ($row = mysqli_fetch_array($risultato, MYSQLI_NUM)) {
                $listaggData = [$row[2], $row[3]];
                echo "<tr>";

                echo "<td> $row[0]</td>";
                echo "<td> $row[1]</td>";
                echo "<td> $row[2]</td>";
                echo "<td> $row[3]</td>";
                echo "<td> $row[4]</td>";

                echo "<td> $row[5]</td>";
                echo "<td> $row[6]</td>";


                echo "<td> $row[8] $row[9]</td>";
                echo "<td class=\"project-actions text-right\">
                                                <ul class=\"list-inline\">
                                                <li style=\"margin-bottom:5px;\">
                                                            <a class=\"btn btn-info btn-sm\" href=\"./schedautente.php?id=$row[7]\">
                                                             <i class=\"fas fa-folder\"> </i> Scheda Cliente</a>
                                                            </li>                                                          
                                                            <li>                                                          
                                                         <a class=\"btn btn-info btn-sm\" href=\"./prenotazioni.php?day=$row[10]\"><i class=\"fas fa-pencil-alt\"> </i> Scheda Prenotzaioni</a>
                                                </li>
                                                </ul>
                        </td>";
                echo " </tr>";

                array_push($listgraph, $listaggData);
                $listaggData = [];
            }
            $con->close();

            include 'grafico.php';
            ?>
      </tbody>
      <div class="card" style="background: #f2f2f2;">
          <div class="card-header border-0">
              <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Grafico Prenotazioni
              </h3>


          </div>
          <div class="card-body">
              <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
          <div class="card-footer bg-transparent">

              <!-- /.row -->
          </div>
          <!-- /.card-footer -->
      </div>
      <script>
          $(function() {
              $("#example1").DataTable({

                  "zeroRecords": "No records to display",
                  "responsive": true,
                  "lengthChange": true,
                  "autoWidth": true,

              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

          });
      </script>