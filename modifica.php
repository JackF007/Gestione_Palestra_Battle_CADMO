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
    header("location:profile.php");
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
                            <h1 class="m-0">Modifica Utente</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Utenti</li>
                                <li class="breadcrumb-item active">Modifica</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Modifica Dati Utente
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="./upload_data.php" method="post">


                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Anagrafici</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Login</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                    <div class="card">
                                        <div class="card-body register-card-body">


                                            <?php
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
                                            <form action="./upload_data.php" method="post">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Nome" name="nome" required value=<?php echo ("$nome"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Cognome" name="cognome" required value=<?php echo ("$cognome"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="date" class="form-control" placeholder="data_nascita" name="data_nascita" required value=<?php echo ("$data"); ?>>
                                                    <div class="input-group-append">

                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Codice Fiscale" name="CF" required value=<?php echo ("$cf"); ?>>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-envelope"></span>
                                                        </div>
                                                    </div>
                                                </div>


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

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="email" name="email" required value=<?php echo ("$email"); ?>>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="password" name="password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100">
                                    <button type="submit" class="btn btn-primary btn-block" name="modificay">Modifica</button>
                                </div>
                        </form>
                    </div>
                </div>
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
    <!-- jQuery UI 1.11.4 -->
    <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="./dist/js/adminlte.min.js"></script>

    <script>
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
                title: 'NON MOdificato',
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






    ?>
</body>

</html>