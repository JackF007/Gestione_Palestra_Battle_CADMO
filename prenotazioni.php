<?php


if (!(isset($_GET['day']) && is_numeric($_GET['day']))) {
    header("location:dashboard.php");
}


?>
<?php
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportgym | Prenotazioni</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php
        include 'dashbase.php';
        ?>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Prenotazioni</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Prenotazioni</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">



                        <h3 class="card-title">
                            <?php
                            $data = date("d-m-Y", $_GET['day']);

                            echo " Prenotazioni del <b>$data</b><br>" ?>


                        </h3>


                        <div class="card-tools">

                            <div class="btn-group">

                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 20%">
                                        Prenotazione
                                    </th>
                                    <th style="width: 10%">
                                        #ID
                                    </th>
                                    <th style="width: 15%">
                                        Cliente
                                    </th>
                                    <th style="width: 20%">
                                        Fascia oraria
                                    </th>
                                    <th style="width: 5%" class="text-center">
                                        Status
                                    </th>
                                    <th style="width: 30%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $orari = array();
                                $k = 0;
                                $fascia = array();
                                if (isset($_GET['day']) && is_numeric($_GET['day'])) {
                                    $day = $_GET['day'];

                                    include 'config.php';
                                    $sql = "SELECT p.id_prenotazione, p.str_data, p.fascia_oraria, a.nome_attivita , p.id_utente_prenotazione , u.nome , u.cognome FROM prenotazioni as p join utenti as u on u.id_utente = p.id_utente_prenotazione join attivita as a on p.tipo_attivita = a.id_attivita WHERE str_data=$day and (stato_prenotazione='intatta'or stato_prenotazione='modificata') order by fascia_oraria ";

                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($fetch = mysqli_fetch_array($result)) {


                                            $idprenot = stripslashes($fetch['id_prenotazione']);
                                            $data = date("d-m-Y", $fetch['str_data']);
                                            $fascia = stripslashes($fetch['fascia_oraria']);
                                            $attivita = stripslashes($fetch['nome_attivita']);
                                            $utenteid = stripslashes($fetch['id_utente_prenotazione']);
                                            $utenteN = stripslashes($fetch['nome']);
                                            $utenteC = stripslashes($fetch['cognome']);

                                            $k++;

                                            array_push($orari,  $fascia);
                                            include 'element.php';
                                        }
                                    }


                                    $orari = serialize($orari);
                                    $orari = urlencode($orari);
                                }
                                ?>


                            </tbody>
                        </table>
                        <?php
                        if ($k < 8) {
                            include 'btn-appuntamento.php';
                        }
                        ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->




            <div class="modal fade" id="modal-danger">
                <div class="modal-dialog">
                    <div class="modal-content bg-danger">

                        <form action="./deleteprenotazione.php" method="post">
                            <input type="hidden" id="id_canc-prenotazione" name="id_canc_prenotazione" value="">
                            <input type="hidden" id="data_prenotazione" name="data_prenotazione" value="<?php echo $_GET['day'] ?>">
                            <div class="modal-header">
                                <h4 class="modal-title">Conferma Cancellazione</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button name="invia-cancellazione" type="submit" class="btn btn-outline-light  w-100" value="invia-prenotazione">Registra Cancellazione</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <footer class=" main-footer ">
            <div class=" float-right d-none d-sm-block ">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2014-2021 SportGym .</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class=" control-sidebar control-sidebar-dark ">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->




    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
  
    <script>
        function logout() {
            window.location = "./logout.php";

        };


        function deleteprnotazione() {
            var target = window.event.target;
            let idcancellazione = target.value || target.value;
           

            document.getElementById("id_canc-prenotazione").value = idcancellazione;

        }

        function successCancellazione() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Cancellato',
                subtitle: '',
                body: 'Cancellazione effettuata con successo'
            })
        };

        function notSuccessCancellazione() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Cancellato',
                subtitle: '',
                body: 'Cancellazione non andata a buon fine'
            })
        };

        function successMod() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Modificato',
                subtitle: '',
                body: 'Modifica effettuata con successo'
            })
        };

        function notSuccessMod() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Modificato',
                subtitle: '',
                body: 'Modifica non andata a buon fine'
            })
        };

      
        function successPrenozazione() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Prenotato',
                subtitle: '',
                body: 'Prenotazione effettuata con successo'
            })
        };

        function notSuccessPrenozazione() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Prenotato',
                subtitle: '',
                body: 'Prenotazione non andata a buon fine'
            })
        };
    </script>
    <?php
    if (isset($_GET['cancellato'])) {

        $cancellato = htmlspecialchars($_GET['cancellato']);
        if ($cancellato == 1) {
            echo "<script>successCancellazione();</script>";
        } else if ($cancellato == 0) {
            echo "<script>notSuccessCancellazione();</script>";
        }
    }
    if (isset($_GET['modificato'])) {

        $modificato = htmlspecialchars($_GET['modificato']);
        if ($modificato == 1) {
            echo "<script>successMod();</script>";
        } else if ($modificato == 0) {
            echo "<script>notSuccessMod();</script>";
        }
    }
    if (isset($_GET['prenotato'])) {

        $prenotato = htmlspecialchars($_GET['prenotato']);
        if ($prenotato == 1) {
            echo "<script>successPrenozazione();</script>";
        } else if ($prenotato == 0) {
            echo "<script>notSuccessPrenozazione();</script>";
        }
    }
 



    ?>
</body>

</html>