<?php
session_start();

if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 500)) {
    $_SESSION = array();
    session_destroy();
    header("Location: ./login.php?timeout=1");
}
$session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');
$mail_log = htmlspecialchars($_SESSION['session_email'], ENT_QUOTES, 'UTF-8');
$id_login = htmlspecialchars($_SESSION['session_login_id'], ENT_QUOTES, 'UTF-8');

if (!(isset($_SESSION['session_id']))) {
    header("location:login.php");
}
$radice = "/ProgettoFinale_Palestra_Battle_CADMO/";
$t = $_SERVER['REQUEST_URI'];
$tmp = str_replace($radice, '', $t); // pagina


require_once('config.php');
$oggi = strtotime(date("Y-m-d"));


$mysqli = $con->query("SELECT *  FROM utenti where login_id='$id_login'"); //cerca soltanto il email utente per poi controllare la password
$result = mysqli_fetch_assoc($mysqli);

$id_utente = $result["id_utente"];

$nome = $result["nome"];
$cognome = $result["cognome"];
$cf = $result["CF"];
$telefono = $result["numero_telefono"];
$data = $result["data_nascita"];
$email = $mail_log;

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
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="dashboard.php" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard.php" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <button type="button" onclick=logout() class="btn btn-outline-primary btn-block"><i class="fa fa-arrow-left"></i> Logout</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <?php
        $radice = "/ProgettoFinale_Palestra_Battle_CADMO/";
        $t = $_SERVER['REQUEST_URI'];
        $tmp = str_replace($radice, '', $t); // pagina

        ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <link rel="stylesheet" href="./dist/css/custom.css">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">


            <a href="dashboard.php" class="brand-link">
                <img src="./dist/img/logo.png" alt="Logo" class="brand-image " style="opacity: .8;margin-top: 6px;">

                <span class="brand-text font-weight-light">Sportgym</span>

            </a>
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class=" user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $mail_log ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                        <li class="nav-item">
                            <a href="profiloutente.php" class="nav-link active">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Profilo
                                </p>
                            </a>
                        </li>

                        <div class="nav-itemCheckIn">


                            <span class="nav-itemCheckIn_icon">
                                <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                            </span>
                            <span class="nav-itemCheckIn__text">Check-In</span>
                            </a>
                            <input hidden type="text" class="qrCode" id="qr-data" onchange="generateQR()">
                            <div id="qrcode"></div>


                            <script src="qrcode.min.js"></script>
                            <script>
                                var qrData = document.getElementById('qr-data');

           
                                var qrCode = new QRCode(document.getElementById("qrcode"));

                                function generateQR() {

                                    $conn = new mysqli($servername, $username, $password);

                                    var data = qrData.value

                                    qrCode.makeCode(data);


                                }
                            </script>



                        </div>

                    </ul>

                </nav>

                <!-- /.sidebar-menu -->



            </div>
            <!-- /.sidebar -->




        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">

                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Profilo Utente</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><a href="#">Home</a></li>

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
                                        <li class="list-group-item">
                                            <b>Data Nascita</b> <a class="float-right"><?php echo $data ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Codice Fiscale</b> <a class="float-right"><?php echo $cf ?></a>
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
                        <div class="col 12 col-sm-9">
                            <div class="card card-primary card-outline">
                                <div class="card-header p-0 border-bottom-0 ml-2 mt-2">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i> Calendario Prenotazioni
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">


                                        <div class="card-body" id="switchCalendar">
                                            <div>
                                                <h3 class="card-title mr-5">
                                                    <span class=" span_blue">
                                                        ●</span> EMPTY
                                                </h3>
                                            </div>
                                            <div>
                                                <h3 class="card-title mr-5 ">
                                                    <span class="span_green">
                                                        ●</span> NOT EMPTY
                                                </h3>
                                            </div>
                                            <div>
                                                <h3 class="card-title mr-5">
                                                    <span class="span_red">
                                                        ●</span>FULL
                                                </h3>
                                            </div>
                                            <?php
                                            function ShowCalendar($m, $y)
                                            {
                                                if ((!isset($_GET['d'])) || ($_GET['d'] == "")) {
                                                    /* data di oggi */
                                                    $m = date('n');
                                                    $y = date('Y');
                                                } else {

                                                    /* data m y da url number */
                                                    $m = intval(date("m", (int)$_GET['d']));
                                                    $y = intval(date("Y", (int)$_GET['d']));
                                                    $m = $m;
                                                    $y = $y;
                                                }


                                                $precedente = mktime(0, 0, 0, $m - 1, 1, $y);
                                                $successivo = mktime(0, 0, 0, $m + 1, 1, $y);
                                                $nomi_mesi = array(
                                                    "Gen",
                                                    "Feb",
                                                    "Mar",
                                                    "Apr",
                                                    "Mag",
                                                    "Giu",
                                                    "Lug",
                                                    "Ago",
                                                    "Set",
                                                    "Ott",
                                                    "Nov",
                                                    "Dic"
                                                );
                                                $nomi_giorni = array(
                                                    "Lun",
                                                    "Mar",
                                                    "Mer",
                                                    "Gio",
                                                    "Ven",
                                                    "Sab",
                                                    "Dom"
                                                );
                                                $cols = 7;
                                                $days = date("t", mktime(0, 0, 0, $m, 1, $y));
                                                $lunedi = date("w", mktime(0, 0, 0, $m, 1, $y));
                                                if ($lunedi == 0) $lunedi = 7;
                                                $tb = "<table class=" . "'" . "table table-bordered >\n" . "'";
                                                echo $tb;
                                                echo "<tr>\n
                                        <td colspan=\"" . $cols . "\">
                                        <a href=\"?d=" . $precedente . "\#switchCalendar\">&lt;&lt;</a>
                                        " . $nomi_mesi[$m - 1] . " " . $y . " 
                                        <a href=\"?d=" . $successivo . "\#switchCalendar\">&gt;&gt;</a></td></tr>";
                                                foreach ($nomi_giorni as $v) {
                                                    echo "<td style=width: 10px><b>" . $v . "</b></td>\n";
                                                }
                                                echo "</tr>";
                                                for ($j = 1; $j < $days + $lunedi; $j++) {
                                                    if ($j % $cols + 1 == 0) {
                                                        echo "<tr>\n"; //apro una riga calendario
                                                    }
                                                    if ($j < $lunedi) {
                                                        echo "<td> </td>\n"; //righe vuote

                                                    } else {

                                                        $day = $j - ($lunedi - 1); // cicla ogni gg


                                                        $data = strtotime(date($y . "-" . $m . "-" . $day)); // cicla ogni data numerica
                                                        $oggi = strtotime(date("Y-m-d"));
                                                        $kont = 0;

                                                        $trov = False;

                                                        include 'config.php';

                                                        $sql = "SELECT str_data FROM prenotazioni where month(data_appuntamento)=$m and year(data_appuntamento)=$y and ( stato_prenotazione='intatta'or stato_prenotazione='modificata')";
                                                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));


                                                        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                                            if ($row[0] == (string)$data) {

                                                                $trov = True;

                                                                break;
                                                            }
                                                        }
                                                        mysqli_free_result($result);

                                                        if ($trov == True) {
                                                            include 'config.php';

                                                            $sql = "SELECT str_data FROM prenotazioni where month(data_appuntamento)=$m and year(data_appuntamento)=$y and ( stato_prenotazione='intatta'or stato_prenotazione='modificata' )";
                                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                                            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                                                if ($row[0] == $data) $kont++;
                                                            }

                                                            if ($kont == 8) {

                                                                $day = "<span class=\"linkmax\">$day</span>";
                                                            } else {

                                                                $day = "<a style=\"color:green\" href=\"newprenotazione.php?day=$data\">$day</a></span>";
                                                            }
                                                        } else {
                                                            $day = "<a href=\"newprenotazione.php?day=$data\">$day</a>";
                                                        }




                                                        if ($data != $oggi) {
                                                            echo "<td>" . $day . "</td>";
                                                        } else {
                                                            echo "<td><b>" . $day . "</b></td>";
                                                        }



                                                        /* fine ciclo mese */
                                                    }
                                                    if ($j % $cols == 0) {
                                                        echo "</tr>";
                                                    }
                                                }
                                                echo "<tr></tr>";
                                                echo "</table>";
                                            }

                                            ShowCalendar(date("m"), date("Y"));
                                            ?>
                                            <!-- Main content -->

                                        </div>

                                    </div>

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="card card-primary card-outline w-100">
                            <div class="card-header p-0 border-bottom-0 ml-2 mt-2">
                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i> Le tue Prenotazioni
                                </h3>
                            </div>
                            <div class="card-body">

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
                                    </thead>
                                    <tbody>
                                        <?php

                                        include 'config.php';
                                        $risultato = $con->query("SELECT id_prenotazione, DATE_FORMAT(data_effettuazione,\"%d-%m-%Y\"), str_data,DATE_FORMAT(data_appuntamento,\"%d-%m-%Y\"), fascia_oraria, id_utente_prenotazione, tipo_attivita, stato_prenotazione, presenza FROM prenotazioni  where id_utente_prenotazione = '$id_utente' and str_data >= '$oggi'");

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




                            <!-- /.card -->
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
    <script src="./dist/js/adminlte.min.js"></script>
    <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>


    <script>
        function logout() {
            window.location = "./logout.php";

        };

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
                title: 'Prenotato',
                subtitle: '',
                body: 'Prenotazione effettuata con successo'
            })
        };


        function notsuccessinserimento() {
            $(document).Toasts('create', {
                class: 'bg-danger', //bg-info bg-warning
                title: 'NON Prenotato',
                subtitle: '',
                body: 'Prenotazione non andata a buon fine'
            })
        };
    </script>
    <?php

    if (isset($_GET['prenotato'])) {

        $prenotato = htmlspecialchars($_GET['prenotato']);
        if ($prenotato == 1) {
            echo "<script>successinserimento();</script>";
        } else {
            echo "<script>notsuccessinserimento();</script>";
        }
    }


    ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>