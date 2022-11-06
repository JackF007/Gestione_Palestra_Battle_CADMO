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
                                    <tbody >
                                    <?php
                                     include 'config.php';
                                        $risultato = $con->query("SELECT p.id_prenotazione, DATE_FORMAT(p.data_effettuazione,\"%d-%m-%Y\") , DATE_FORMAT(p.data_appuntamento,\"%d-%m-%Y\"), p.fascia_oraria, a.nome_attivita  , p.stato_prenotazione,p.presenza, p.id_utente_prenotazione,  u.nome , u.cognome , p.str_data FROM prenotazioni as p join utenti as u on u.id_utente = p.id_utente_prenotazione join login as l on l.login_id = u.login_id  join attivita as a on p.tipo_attivita = a.id_attivita WHERE p.str_data>1 and l.stato>0 order by p.data_appuntamento desc ");

                                        while ($row = mysqli_fetch_array($risultato, MYSQLI_NUM)) {

                                            echo "<tr>";

                                            echo "<td> $row[0]</td>";
                                            echo "<td> $row[1]</td>";
                                            echo "<td> $row[2]</td>";
                                            echo "<td> $row[3]</td>";
                                            echo "<td> $row[4]</td>";

                                            echo "<td> $row[5]</td>";
                                            echo "<td> $row[6]</td>";


                                            echo "<td> $row[8] $row[9]</td>";
                                            echo " </tr>";
                                        }
                                        $con->close();
                                        ?>
                                    </tbody>
                                
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


   








