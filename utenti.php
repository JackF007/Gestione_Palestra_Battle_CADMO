<?php
session_start();

if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 1000)) {
    $_SESSION = array();
    session_destroy();
    header("Location: ./index.php?timeout=1");
}
$session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');


if (!(isset($_SESSION['session_id']))) {
    header("location:index.php");
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
    <title>Sportgym | Utenti | Cerca </title>
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
                            <h1 class="m-0">Cerca Utenti</h1>
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Utenti</li>
                                <li class="breadcrumb-item active">Cerca</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->



            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <!-- row -->
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Utenti</h3>
                            </div>
                            <div class="card-body">

                                <div class="card">

                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Utente</th>
                                                    <th>Contatto</th>
                                                    <th>Data nascita</th>
                                                    <th>CF</th>
                                                    <th>Mail</th>
                                                    <th>Ruolo</th>
                                                    <th></th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'config.php';
                                                $risultato = $con->query("SELECT u.id_utente, u.nome, u.cognome, u.numero_telefono, DATE_FORMAT(u.data_nascita,\"%d-%m-%Y\"), u.CF, l.email , l.ruolo , l.login_id FROM utenti as u join login as l on l.login_id = u.login_id where l.stato = 1");

                                                while ($row = mysqli_fetch_array($risultato, MYSQLI_NUM)) {

                                                    echo "<tr>";
                                                    echo "<td><ul class=\"list-inline\"><li>$row[1]</li><li>$row[2]</li></td>";
                                                    echo "<td> $row[3]</td>";
                                                    echo "<td> $row[4]</td>";
                                                    echo "<td> $row[5]</td>";
                                                    echo "<td> $row[6]</td>";
                                                    echo "<td> $row[7]</td>";
                                                    echo "<td class=\"project-actions text-right\">
                                                <ul class=\"list-inline\">
                                                <li>
                                                            <a class=\"btn btn-info btn-sm\" href=\"./schedautente.php?id=$row[0]\">
                                                             <i class=\"fas fa-folder\"> </i> Apri Scheda</a>
                                                            </li>                                                          
                                                            <li>                                                          
                                                            <a id=\"$row[1] $row[2]\"  onclick =\"setform()\" data-login=\"$row[8]\" type=\"button\" class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#modal-primary\">
                                                             <i class=\"fas fa-trash\"> </i> Delete</a>
                                                </li>
                                                </ul>
                                                             </td>";
                                                    echo " </tr>";
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
                                            <div class="modal-header">
                                                <h4 class="modal-title">Cancella Utenti</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="delete_utente" action="./upload_data.php" method="post">
                                                <p id="id_nominativo" class="p-3"></p>
                                                <input type="hidden" id="id_deletelogin" name="id_delete" value="">
                                                <div class="modal-footer justify-content-between">
                                                    <input class="btn btn-outline-light  w-100" type="submit" value="Conferma Cancellazione" name="Delete">
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
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
    <script src="./dist/js/adminlte.min.js"></script>
    <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
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


    <!-- Page specific script -->
    <script>
        function logout() {
            window.location = "./logout.php";

        };
        $(function() {
            $("#example1").DataTable({

                "zeroRecords": "Nessun risultato",
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });

        function successinserimento() {
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Cancellato',
                subtitle: '',
                body: 'Cancellato con successo'
            })
        };


        function notsuccessinserimento() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Cancellato',
                subtitle: '',
                body: 'Non andato a buon fine'
            })
        };



        function setform() {
            var target = window.event.target;
            let id_cli = target.getAttribute('data-login') || target.getAttribute('data-login');

            console.log(id_cli)
            let nominativo = target.id
            let Inominiativo = "Utente da Cancellare: " + nominativo
            document.getElementById('id_deletelogin').value = id_cli;
            document.getElementById('id_nominativo').innerHTML = Inominiativo;
        }
    </script>
    <?php

    if (isset($_GET['cancellato'])) {

        $cancellato = htmlspecialchars($_GET['cancellato']);
        if ($cancellato == 1) {
            echo "<script>successinserimento();</script>";
        } else {
            echo "<script>notsuccessinserimento();</script>";
        }
    }


    ?>
</body>

</html>