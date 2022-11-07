<?php
if (!(isset($_POST['day']) || isset($_POST['fascia']))) {
    header("location:dashboard.php");
}
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
    <title>Sportgym | Prenotazioni | Nuova</title>
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

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <link rel="stylesheet" href="./dist/css/custom.css">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="dashboard.php" class="brand-link">
                <img src="./dist/img/logo.png" alt="Logo" class="brand-image " style="margin-top: 6px;">
                <span class="brand-text font-weight-bold "><strong style="font-size: larger;">Sportgym</strong></span>
            </a>
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class=" user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <em style="color:white"><?php echo $mail_log ?></em>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-duotone fa-user nav-icon"></i>
                                <p>
                                    Utenti
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="utenti.php" class="nav-link">
                                        <i class="nav-icon fa fa-solid fa-address-book"></i>
                                        <p>Ricerca Utente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href\"register.php" class="nav-link" <i class="nav-icon far fa fa-user-plus"></i>
                                        <p>Aggiungi Utente</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="background: none; color: #007bff;">
                                <i class="nav-icon fas fa-laptop-house"></i>
                                <p>
                                    Domotica
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <ul style="border-radius: 10px; background: white;">
                                    <li class="nav-item" style="display: flex; align-items: baseline;">
                                        <div id="comandoLuce" style="width: 50%;">
                                            <?php
                                            include 'config.php';

                                            $sql = "SELECT * FROM domotica";
                                            $result = mysqli_query($con, $sql) or die(mysqli_error($con));


                                            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                                if ($row[1] == 0) {

                                                    echo  "<label class=\"toggle\" for=\"myToggleLuce\" style=\"max-width: 40px;margin: 32px auto 20px auto;\">
                                          <input class=\"toggle__input\" type=\"checkbox\" onclick=\"ToggleLuce()\" id=\"myToggleLuce\" value=\"off\" >";
                                                } else {

                                                    echo  "<label class=\"toggle\" for=\"myToggleLuce\" style=\"max-width: 40px;margin: 32px auto 20px auto;\">
                                          <input class=\"toggle__input\" type=\"checkbox\" onclick=\"ToggleLuce()\" id=\"myToggleLuce\" value=\"on\" checked>";
                                                }
                                                $rowtemp = $row[2];
                                                $rowluce = $row[1];
                                            }

                                            ?>
                                            <div class="toggle__fill "></div>
                                            </label>
                                        </div>
                                        <div class="" style="margin: auto;">
                                            <?php
                                            if ($rowluce == 0) {
                                                echo "  <img id=\"imgluce\" src=\"./dist/img/lightbulbminimono_105785.png\" alt=\"OFF\" width=\"40\" height=\"40\" style=\"border: 5px solid white;background: white;border-radius: 50%;    margin: auto;\"></span>";
                                            } else echo "  <img id=\"imgluce\" src=\"./dist/img/lightbulbflat_106023.png\" alt=\"OFF\" width=\"40\" height=\"40\" style=\"border: 5px solid white;background: white;border-radius: 50%;    margin: auto;\"></span>";
                                            ?>


                                        </div>
                                    </li>

                                </ul>
                                <li class="nav-item">
                                    <div class="range" style=" margin-left: auto; margin-right: auto;">
                                        <div class="sliderValue">
                                            <span>0°</span>
                                        </div>
                                        <div class="field">
                                            <div class="value left">
                                                0</div>
                                            <input id="temper" type="range" min="0" max="50" value="<?php echo $rowtemp ?>" steps="1">
                                            <div class="value right">
                                                50° </div>
                                        </div>
                                    </div>

                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
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
                $sql = "SELECT  COUNT('id_prenotazione')  FROM prenotazioni WHERE str_data='$day' and stato_prenotazione= 'intatta' or stato_prenotazione= 'modificata'"; //count su
                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                $numrow = $row[0] - 1;
                $siquery = 1;
                if ($numrow >= 8) {
                    $siquery = 0;
                }
            }

            ?>
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
                                                          <?php if  ($siquery==0){
                                                            echo "<button name=\"invia-prenotazione\" type=\"submit\" class=\"btn btn-outline-light  w-100\" value=\"invia-prenotazione\">Registra Prenotazione</button>";
                                                          }else  {
                                                                echo "<button name=\"invia-prenotazione\" type=\"submit\" class=\"btn btn-outline-light  w-100\" value=\"invia-prenotazione\" disabled>Registra Prenotazione</button>";
                                                            }
                                                          ?>
                                                          
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
    <!-- ChartJS -->
    <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="./plugins/chart.js/Chart.min.js"></script>

    <script src="./dist/js/adminlte.min.js"></script>
    <script>
        function ToggleLuce() {
            let img = document.getElementById("imgluce")
            let stato = document.getElementById("myToggleLuce").value

            if (stato == "off") {
                document.getElementById("myToggleLuce").value = "on"
                img.src = "./dist/img/lightbulbflat_106023.png";

            }
            if (stato == "on") {

                document.getElementById("myToggleLuce").value = "off"
                img.src = "./dist/img/lightbulbminimono_105785.png";

            }
        }





        function succes() {
            var val = document.getElementById("myToggleLuce").value;
            var temp = document.getElementById("temper").value
            $(document).Toasts('create', {
                class: 'bg-success', //bg-info bg-warning
                title: 'Domotica',
                subtitle: '',
                body: "Luci:=" + val + "</br>Temperatura:=" + temp
            })
        }

        function sendval() {
            var val = document.getElementById("myToggleLuce").value;
            $.ajax({
                url: "domoticaupload.php",
                type: "post",
                data: {
                    luce: val,

                },


                success: function(response) {
                    succes()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            });
        }

        function sendtemp() {
            var temp = document.getElementById("temper").value
            $.ajax({
                url: "domoticaupload.php",
                type: "post",
                data: {
                    temperatura: temp,
                },
                success: function(response) {
                    succes()
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $("#myToggleLuce").change(function() {
            sendval();
        });
        $("#temper").change(function() {
            sendtemp();
        });
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