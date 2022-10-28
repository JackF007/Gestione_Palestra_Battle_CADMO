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
    <title>Sportgym | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="./dist/css/custom.css">
    <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="./plugins/toastr/toastr.min.css">
</head>

<body id="register" class="hold-transition sidebar-mini layout-fixed">
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
                            <h1 class="m-0">Registra Utente</h1>
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Utenti</li>
                                <li class="breadcrumb-item active">Registra</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <section class="content">
                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Registra Dati Nuovo Utente
                        </h3>
                    </div>
                    <div class="card-body">

                        <form action="./upload_data.php" method="post">
                            <label for="ruolo">Ruolo</label>
                            <div class="input-group mb-3">
                                <input type="radio" id="cliente" name="ruolo" value="cliente" required>
                                <label for="age1" class="mr-2">Cliente</label>
                                <input type="radio" id="amministrazione" name="ruolo" value="amministrazione" required>
                                <label for="age2">Amministrazione</label>

                            </div>
                            <hr>
                            <label for="nome">Nome Utente</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nome" name="nome" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <label for="cognome">Cognome Utente</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cognome" name="cognome" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <label for="data_nascita">Data di nascita</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="data_nascita" name="data_nascita" required>
                                <div class="input-group-append">

                                </div>
                            </div>
                            <label for="CF">Codice Fiscale</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Codice Fiscale" name="CF" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <label for="numero">Numero telefono</label>
                            <div class="input-group mb-3">
                                <input placeholder="Telefono" type="number" class="form-control" data-mask name="numero" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label for="email">Email Utente</label>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="email" name="email" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>

                            <label for="password">Password Utente</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="password" name="password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- /.col -->

                                <button type="submit" class="btn btn-primary btn-block w-100" name="register">Registra</button>

                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.form-box -->
                </div>

            </section>
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
    <!-- jQuery UI 1.11.4 -->
    <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="./dist/js/adminlte.min.js"></script>

    <script>
        function logout() {
            window.location = "./logout.php";

        };

        function successinserimento() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Inserito',
                subtitle: '',
                body: 'Inserimento effettuato con successo'
            })
        };


        function notsuccessinserimento() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Inserito',
                subtitle: '',
                body: 'Inserimento non andato a buon fine'
            })
        };

        function empty() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'Mail o Password vuoti ',
                subtitle: '',
                body: 'Inserimento non andato a buon fine'
            })
        };

        function exist() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'Mail già in uso',
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
        } else if ($inserito == 0) {
            echo "<script>notsuccessinserimento();</script>";
        }
    }
    if (isset($_GET['empty'])) {

        $empty = htmlspecialchars($_GET['empty']);
        if ($empty == 1) {
            echo "<script>empty();</script>";
        }
    }
    if (isset($_GET['exist'])) {

        $exist = htmlspecialchars($_GET['exist']);
        if ($exist == 1) {
            echo "<script>exist();</script>";
        }
    }





    ?>

</body>

</html>