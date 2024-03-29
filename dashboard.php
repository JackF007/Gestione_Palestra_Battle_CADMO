
<?php
session_start();
if (isset($_SESSION['data']) && (time() - $_SESSION['data'] > 500)) {
    $_SESSION = array();
    session_destroy();
    header("Location: ./login.php?timeout=1");
}
  $session_ruolo = htmlspecialchars($_SESSION['session_ruolo'], ENT_QUOTES, 'UTF-8');
if (!(isset($_SESSION['session_id']))||(isset($_SESSION['session_id']) &&"amministrazione"!= $session_ruolo)) {
    /*   $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8'); */
    /*   $session_id = htmlspecialchars($_SESSION['session_id']); */
    header("location:login.php");
} 

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
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->
        <!-- Navbar -->
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
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php
        include 'sidebar.php';
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
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
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>New Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                                    <p>Bounce Rate</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>44</h3>
                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>65</h3>
                                    <p>Unique Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!--  row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <!-- Calendar -->
                            <div class="card ">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i> Calendario Prenotazioni
                                    </h3>

                                    <!-- tools card -->
                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
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

                                                $sql = "SELECT str_data FROM prenotazioni where month(data_appuntamento)=$m and year(data_appuntamento)=$y";
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

                                                    $sql = "SELECT str_data FROM prenotazioni where month(data_appuntamento)=$m and year(data_appuntamento)=$y";
                                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                                    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                                        if ($row[0] == $data) $kont++;
                                                    }

                                                    if ($kont == 8) {

                                                        $day = "<span class=\"linkmax\"><a href=\"prenotazioni.php?day=$data\">$day</a></span>";
                                                    } else {

                                                        $day = "<a style=\"color:green\" href=\"prenotazioni.php?day=$data\">$day</a></span>";
                                                    }
                                                } else {
                                                    $day = "<a href=\"prenotazioni.php?day=$data\">$day</a>";
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
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- right col -->
                    </div>
                    <!--  row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i> Prenotazioni Odierne
                                    </h3>
                                    <!-- tools card -->
                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
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
                                            $oggi = strtotime(date("Y-m-d"));
                                            include 'config.php';
                                            $sql = "SELECT p.id_prenotazione, p.str_data, p.fascia_oraria, a.nome_attivita , p.id_utente_prenotazione , u.nome , u.cognome FROM prenotazioni as p join utenti as u on u.id_utente = p.id_utente_prenotazione join attivita as a on p.tipo_attivita = a.id_attivita WHERE str_data=$oggi and stato_prenotazione='intatta'";
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

                                                    include 'element.php';
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </section>

            <div class="card card-info card-outline">

                <div class="card-body">
                    <button type="button" class="btn btn-success toastsDefaultSuccess">
                        Launch Success Toast
                    </button>
                    <button type="button" class="btn btn-info toastsDefaultInfo">
                        Launch Info Toast
                    </button>
                    <button type="button" class="btn btn-warning toastsDefaultWarning">
                        Launch Warning Toast
                    </button>
                    <button type="button" class="btn btn-danger toastsDefaultDanger">
                        Launch Danger Toast
                    </button>
                    <button type="button" class="btn btn-default bg-maroon toastsDefaultMaroon">
                        Launch Maroon Toast
                    </button>
                    <div class="text-muted mt-3">

                    </div>
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
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });



            $('.toastsDefaultSuccess').click(function() {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.toastsDefaultInfo').click(function() {
                $(document).Toasts('create', {
                    class: 'bg-info',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.toastsDefaultWarning').click(function() {
                $(document).Toasts('create', {
                    class: 'bg-warning',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.toastsDefaultDanger').click(function() {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.toastsDefaultMaroon').click(function() {
                $(document).Toasts('create', {
                    class: 'bg-maroon',
                    title: 'Toast Title',
                    subtitle: 'Subtitle',
                    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
        });
    </script>

</body>

</html>