<!DOCTYPE html>
<?php
if (!(isset($_POST['day']) || isset($_POST['fascia']))) {
    header("location:dashboard.php");
}
session_start();

if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 500)) {
    $_SESSION = array();
    session_destroy();
    header("Location: ./login.php?timeout=1");
}
$session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');


if (!(isset($_SESSION['session_id']))) {
    header("location:login.php");
} else if ("amministrazione" != $session_ruolo) {
    header("location:profiloutente.php");
}

$mail_log = $_SESSION['session_email'];
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportgym | Prenotazioni | Nuova</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="./dist/css/custom.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include 'dashbase.php';
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Nuova Prenotazione</h1>
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Prenotazioni</li>
                                <li class="breadcrumb-item active">Nuova</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <?php

            if ((isset($_POST['day']) && isset($_POST['fascia']))) { // passaggio valori automatici
                $day = $_POST['day'];
                $m = (date("m", (int)$_POST['day']));
                $y = (date("Y", (int)$_POST['day']));
                $d  = (date("d", (int)$_POST['day']));
                $fascia = $_POST['fascia'];
                $fascia = unserialize(urldecode($fascia));
                include 'config.php';
                $sql = "SELECT  COUNT('id_prenotazione') AS idp  FROM prenotazioni WHERE str_data='$day' and stato_prenotazione= 'intatta' or stato_prenotazione= 'modificata'"; //count su
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                $numrow= $row[0]-1;
                   
                    if($numrow>=8) header("location:dashboard.php"); 
                    
                
            }
            ?>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <!-- row -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Modulo di Prenotazione</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <form action="./verifyprenotazione.php" method="post">
                                        <label>Data Selezionata</label>
                                        <!-- Date mm/dd/yyyy -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>

                                                <input type="text" name"data" class="form-control" placeholder="<?php echo $d . "/" . $m . "/" . $y ?>" disabled>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="form-group">
                                            <label>Seleziona Fascia oraria</label>
                                            <select id="selectform" class="form-control select2" name"fascia" style="width: 100%;">

                                                <?php
                                                $defaultFascia = array("08-09", "09-10", "10-11", "11-12", "12-13", "15-16", "16-17", "17-18");

                                                foreach ($defaultFascia as $f) {
                                                    if (!(in_array($f, $fascia))) {
                                                        echo "<option>$f</option>";
                                                    }
                                                }

                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Seleziona Attività</label>
                                            <select id="selectattivita" class="form-control select2" name"attivita" style="width: 100%;">
                                                <option>Sauna</option>


                                            </select>
                                        </div>

                                        <!-- /.form group -->
                                        <label>Seleziona Cliente</label>
                                        <div class="card">

                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>Cognome</th>
                                                            <th>Data Nascita</th>
                                                            <th>Email</th>
                                                            <th>Ruolo</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include 'config.php';
                                                        $risultato = $con->query("SELECT u.id_utente, u.nome, u.cognome, u.data_nascita,  l.email , l.ruolo  FROM utenti as u join login as l on l.login_id = u.login_id ");

                                                        while ($row = mysqli_fetch_array($risultato, MYSQLI_NUM)) {

                                                            echo "<tr>";

                                                            echo "<td> $row[1]</td>";
                                                            echo "<td> $row[2]</td>";
                                                            echo "<td> $row[3]</td>";
                                                            echo "<td> $row[4]</td>";
                                                            echo "<td> $row[5]</td>";
                                                            echo "<td><button id=\"$row[0]_button\" onclick =\"setform()\" value = \"$row[0]\" type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#modal-primary\">
                                                                    Prenota
                                                                </button></td></tr>";
                                                        }

                                                        ?>


                                                    </tbody>

                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>

                                        <div class="modal fade" id="modal-primary">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-primary">
                                                    <form action="/verifyprenotazione.php" method="post">
                                                        <input type="hidden" id="data_prenotazioneForm" name="data_prenotazione" value="">
                                                        <input type="hidden" id="fascia_prenotazioneForm" name="fascia_prenotazione" value="">
                                                        <input type="hidden" id="attivita_prenotazioneForm" name="attivita_prenotazioneForm" value="">
                                                        <input type="hidden" id="str_data" name="str_data" value="<?php echo $day ?>">

                                                        <input type="hidden" id="id_clienteForm" name="id_cliente" value="">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Conferma Prenotazione</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-footer justify-content-between">

                                                            <button name="invia-prenotazione" type="submit" class="btn btn-outline-light  w-100" value="invia-prenotazione">Registra Prenotazione</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </section>
        </div>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2022 SportGym .</strong> built together with html.it.
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

      <script src="./plugins/jquery/jquery.min.js"></script>
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./dist/js/adminlte.min.js"></script>
    <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function logout() {
            window.location = "./logout.php";

        };

        $(function() {
            $("#example1").DataTable({
                "zeroRecords": "No records to display",
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 1,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        let formSelect = document.getElementById("selectform");
        let m = <?php echo json_encode($m); ?>;
        let y = <?php echo json_encode($y); ?>;
        let d = <?php echo json_encode($d); ?>;
        let dataPrenotazione = y + "-" + m + "-" + d;
        let selectattivita = document.getElementById("selectattivita");

        function setform() {
            var inSelectedFascia = formSelect.options[formSelect.selectedIndex].text;
            var inSelectedattivita = selectattivita.options[selectattivita.selectedIndex].text;

            var target = window.event.target;
            let id_cli = target.value || target.value;

            document.getElementById('fascia_prenotazioneForm').value = inSelectedFascia;
            document.getElementById('data_prenotazioneForm').value = dataPrenotazione;
            document.getElementById('attivita_prenotazioneForm').value = inSelectedattivita;
            document.getElementById('id_clienteForm').value = id_cli;


        }
    </script>

</body>

</html>