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
$radice = "/ProgettoFinale_Palestra_Battle_CADMO/";
$t = $_SERVER['REQUEST_URI'];
$tmp = str_replace($radice, '', $t); // pagina

$mail_log = $_SESSION['session_email'];

if ($tmp == "schedautente.php") {
    header("location:dashboard.php");
}

require_once('config.php');

$id_utente = $_GET["id"];

$mysqli = $con->query("SELECT *  FROM utenti where id_utente='$id_utente'"); //cerca soltanto il email utente per poi controllare la password
$result = mysqli_fetch_assoc($mysqli);

$id_login = $result["login_id"];
$nome = $result["nome"];
$cognome = $result["cognome"];
$cf = $result["CF"];
$telefono = $result["numero_telefono"];
$data = $result["data_nascita"];

$risultato = $con->query("SELECT * FROM login where login_id='$id_login'"); //cerca soltanto il email utente per poi controllare la password
$risultato_bello = mysqli_fetch_assoc($risultato);
$email = $risultato_bello["email"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportgym | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
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
                            <h1 class="m-0">Scheda Utente</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><a href="./utenti.php"> Utenti</a></li>
                                <li class="breadcrumb-item active">Scheda</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="./dist/img/user4-128x128.jpg" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $nome . " " . $cognome ?></h3>



                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?php echo $email ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Numero telefono</b> <a class="float-right"><?php echo $telefono ?></a>
                                        </li>

                                    </ul>

                                    <a href="#" class="btn btn-primary btn-block"><b>Contact</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-9">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Storico Prenotazioni</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Modifica profilo</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
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
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include 'config.php';
                                                    $risultato = $con->query("SELECT * FROM prenotazioni where id_utente_prenotazione = '$id_utente'");

                                                    while ($row = mysqli_fetch_array($risultato, MYSQLI_NUM)) {

                                                        echo "<tr>";

                                                        echo "<td> $row[0]</td>";
                                                        echo "<td> $row[1]</td>";
                                                        echo "<td> $row[3]</td>";
                                                        echo "<td> $row[4]</td>";
                                                        if ($row[6] == 1) {
                                                            echo "<td>Sauna</td>";
                                                        }
                                                        echo "<td> $row[7]</td>";
                                                        echo "<td> $row[8]</td>";
                                                        echo " </tr>";
                                                    }
                                                    $con->close();

                                                    ?>

                                                </tbody>

                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                                            <form action="./upload_data.php" method="post">
                                                <label for="nome">Nome</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Nome" name="nome" required value=<?php echo ("$nome"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="cognome">Cognome</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Cognome" name="cognome" required value=<?php echo ("$cognome"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="data_nascita">data_nascita</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" placeholder="data_nascita" name="data_nascita" required value=<?php echo ("$data"); ?>>
                                                    <div class="input-group-append">

                                                    </div>
                                                </div>
                                                <label for="CF">CF</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Codice Fiscale" name="CF" required value=<?php echo ("$cf"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <label for="numero">Numero</label>
                                                <div class="input-group mb-3">
                                                    <input placeholder="Telefono" type="number" class="form-control" data-mask name="numero" required value=<?php echo ("$telefono"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-phone"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="input-group mb-3">
                                                    <input type="hidden" class="form-control" placeholder="id_utente" name="id_utente" value="<?php echo $id_utente ?>" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="hidden" class="form-control" placeholder="id_login" name="id_login" value="<?php echo $id_login ?>" required>
                                                </div>
                                                <!-- /.col -->
                                                <label for="email">Email</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" placeholder="email" name="email" required value=<?php echo ("$email"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="password">Nuova Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" placeholder="password" name="password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-100">
                                                    <button type="submit" class="btn btn-primary btn-block" name="modificay">Modifica</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>




        </div>

    </div>


    </div>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2022 SportGym .</strong> All rights reserved.
    </footer>
    <!-- Control Sidebar -->


    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="./plugins/jszip/jszip.min.js"></script>
    <script src="./plugins/pdfmake/pdfmake.min.js"></script>
    <script src="./plugins/pdfmake/vfs_fonts.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>
    <!-- Page specific script -->

    <script>
        $(function() {
            $("#example1").DataTable({

                "zeroRecords": "No records to display",
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });

        function successinserimento() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Modificato',
                subtitle: '',
                body: 'Inserimento effettuato con successo'
            })
        };


        function notsuccessinserimento() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Modificato',
                subtitle: '',
                body: 'Inserimento non andato a buon fine'
            })
        };
    </script>
    <?php

    if (isset($_GET['inserito'])) {

        $inserito = htmlspecialchars($_GET['inserito']);
        if ($inserito == 1) {
            echo "<script>successinserimento();</script>";
        } else {
            echo "<script>notsuccessinserimento();</script>";
        }
    }


    ?>
    <script>
        function logout() {
            window.location = "./logout.php";

        };
    </script>
</body>

</html>