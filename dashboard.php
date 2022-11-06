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
$k8_9 = 0;
$k9_10 = 0;
$k10_11 = 0;
$k11_12 = 0;
$k12_13 = 0;
$k15_16 = 0;
$k16_17 = 0;
$k17_18 = 0;
include 'config.php';
$sql = "SELECT fascia_oraria FROM prenotazioni  where data_appuntamento = CURRENT_DATE() and (stato_prenotazione= 'intatta' or stato_prenotazione= 'modificata')";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$kont_gg = 0; //numero prenotazioni today
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $kont_gg++;
    if ($row[0] == "08-09") {
        $k8_9++;
    } else if ($row[0] == "09-10") {
        $k9_10++;
    } else if ($row[0] == "10-11") {
        $k10_11++;
    } else if ($row[0] == "11-12") {
        $k11_12++;
    } else if ($row[0] == "12-13") {
        $k12_13++;
    } else if ($row[0] == "15-16") {
        $k15_16++;
    } else if ($row[0] == "16-17") {
        $k16_17++;
    } else if ($row[0] == "17-18") {
        $k17_18++;
    }
}
mysqli_free_result($result);

///////////////////

$S8_9 = 0;
$S9_10 = 0;
$S10_11 = 0;
$S11_12 = 0;
$S12_13 = 0;
$S15_16 = 0;
$S16_17 = 0;
$S17_18 = 0;
$timestamp = strtotime("now");

$m = intval(date("m", (int)$timestamp));
$y = intval(date("Y", (int)$timestamp));
$g = intval(date("d", (int)$timestamp));

$timestamp = date('d-m-Y', $timestamp);

function giornoData($g, $m, $a)
{
    $gShort = array('Dom', 'Lun', 'Mart', 'Merc', 'Giov', 'Ven', 'Sab');
    $ts = mktime(0, 0, 0, $m, $g, $a);
    $gd = getdate($ts);
    return $gd['wday'];
}
$ggoftoday = giornoData($g, $m, $y) - 1;

$addtime = strtotime("-" . $ggoftoday . " day", strtotime("now"));

$timestamp = date('Y-m-d', $addtime); //data inizio settimana da corrente

$sql = "SELECT fascia_oraria FROM prenotazioni  where data_appuntamento >= '$timestamp' and data_appuntamento <= CURRENT_DATE() and (stato_prenotazione= 'intatta' or stato_prenotazione= 'modificata')";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$kont_sett = 0; //numero prenotazioni today
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $kont_sett++;
    if ($row[0] == "08-09") {
        $S8_9++;
    } else if ($row[0] == "09-10") {
        $S9_10++;
    } else if ($row[0] == "10-11") {
        $S10_11++;
    } else if ($row[0] == "11-12") {
        $S11_12++;
    } else if ($row[0] == "12-13") {
        $S12_13++;
    } else if ($row[0] == "15-16") {
        $S15_16++;
    } else if ($row[0] == "16-17") {
        $S16_17++;
    } else if ($row[0] == "17-18") {
        $S17_18++;
    }
}
mysqli_free_result($result);



/////////////////////////
$M8_9 = 0;
$M9_10 = 0;
$M10_11 = 0;
$M11_12 = 0;
$M12_13 = 0;
$M15_16 = 0;
$M16_17 = 0;
$M17_18 = 0;
$timestamp = strtotime("now");

$m = intval(date("m", (int)$timestamp));
$y = intval(date("Y", (int)$timestamp));
$g = intval(date("d", (int)$timestamp));
$stringaInitMese = $y . "-" . $m . "-01";

$sql = "SELECT fascia_oraria FROM prenotazioni  where data_appuntamento >= '$stringaInitMese' and data_appuntamento <= CURRENT_DATE() and (stato_prenotazione= 'intatta' or stato_prenotazione= 'modificata')";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$kont_mm = 0; //numero prenotazioni today
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $kont_mm++;
    if ($row[0] == "08-09") {
        $M8_9++;
    } else if ($row[0] == "09-10") {
        $M9_10++;
    } else if ($row[0] == "10-11") {
        $M10_11++;
    } else if ($row[0] == "11-12") {
        $M11_12++;
    } else if ($row[0] == "12-13") {
        $M12_13++;
    } else if ($row[0] == "15-16") {
        $M15_16++;
    } else if ($row[0] == "16-17") {
        $M16_17++;
    } else if ($row[0] == "17-18") {
        $M17_18++;
    }
}
mysqli_free_result($result);


/////////////////////////
$A8_9 = 0;
$A9_10 = 0;
$A10_11 = 0;
$A11_12 = 0;
$A12_13 = 0;
$A15_16 = 0;
$A16_17 = 0;
$A17_18 = 0;
$timestamp = strtotime("now");

$m = intval(date("m", (int)$timestamp));
$y = intval(date("Y", (int)$timestamp));
$g = intval(date("d", (int)$timestamp));
$stringaInitanno = $y . "-01-01"; //da inizio anno

$sql = "SELECT fascia_oraria FROM prenotazioni  where data_appuntamento >= '$stringaInitanno' and data_appuntamento <= CURRENT_DATE()  and (stato_prenotazione= 'intatta' or stato_prenotazione= 'modificata')";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

$kont_aa = 0; //numero prenotazioni today
while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $kont_aa++;
    if ($row[0] == "08-09") {
        $A8_9++;
    } else if ($row[0] == "09-10") {
        $A9_10++;
    } else if ($row[0] == "10-11") {
        $A10_11++;
    } else if ($row[0] == "11-12") {
        $A11_12++;
    } else if ($row[0] == "12-13") {
        $A12_13++;
    } else if ($row[0] == "15-16") {
        $A15_16++;
    } else if ($row[0] == "16-17") {
        $A16_17++;
    } else if ($row[0] == "17-18") {
        $A17_18++;
    }
}
mysqli_free_result($result);

$con->close();





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="title-inverted">Sportgym | Dashboard</title>
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
        <?php
        include 'dashbase.php';
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header" id="headerBlock">
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
                            <div class="small-box bg-info mb-0">
                                <div class="inner">
                                    <h3><?php echo $kont_gg ?></h3>
                                    <p>Prenotazioni Odierne</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                            <div class="w-100">
                                <div class="card">

                                    <div id="accordion">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                                <div class="card">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-0">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Fascia oraria</th>
                                                                    <th style="width: 40px">totale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>fascia oraria 8-9</td>
                                                                    <td><span class="badge bg-info"><?php echo $k8_9 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2.</td>
                                                                    <td>fascia oraria 9-10</td>
                                                                    <td><span class="badge bg-info"><?php echo $k9_10 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3.</td>
                                                                    <td>fascia oraria 10-11</td>
                                                                    <td><span class="badge bg-info"><?php echo $k10_11 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4.</td>
                                                                    <td>fascia oraria 11-12</td>
                                                                    <td><span class="badge bg-info"><?php echo $k11_12 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5.</td>
                                                                    <td>fascia oraria 12-13</td>
                                                                    <td><span class="badge bg-info"><?php echo $k12_13 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6.</td>
                                                                    <td>fascia oraria 15-16</td>
                                                                    <td><span class="badge bg-info"><?php echo $k15_16 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7.</td>
                                                                    <td>fascia oraria 16-17</td>
                                                                    <td><span class="badge bg-info"><?php echo $k16_17 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8.</td>
                                                                    <td>fascia oraria 17-18</td>
                                                                    <td><span class="badge bg-info"><?php echo $k17_18 ?></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success mb-0">
                                <div class="inner">
                                    <h3><?php echo $kont_sett ?></h3>
                                    <p>Prenotazioni Settimanali</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>

                                </div>

                            </div>
                            <div class="w-100">
                                <div class="card">

                                    <div id="accordion2">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapsetwo" aria-expanded="false">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsetwo" class="collapse" data-parent="#accordion2" style="">
                                                <div class="card">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-0">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Fascia oraria</th>
                                                                    <th style="width: 40px">totale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>fascia oraria 8-9</td>
                                                                    <td><span class="badge bg-success"><?php echo $S8_9 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2.</td>
                                                                    <td>fascia oraria 9-10</td>
                                                                    <td><span class="badge bg-success"><?php echo $S9_10 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3.</td>
                                                                    <td>fascia oraria 10-11</td>
                                                                    <td><span class="badge bg-success"><?php echo $S10_11 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4.</td>
                                                                    <td>fascia oraria 11-12</td>
                                                                    <td><span class="badge bg-success"><?php echo $S11_12 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5.</td>
                                                                    <td>fascia oraria 12-13</td>
                                                                    <td><span class="badge bg-success"><?php echo $S12_13 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6.</td>
                                                                    <td>fascia oraria 15-16</td>
                                                                    <td><span class="badge bg-success"><?php echo $S15_16 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7.</td>
                                                                    <td>fascia oraria 16-17</td>
                                                                    <td><span class="badge bg-success"><?php echo $S16_17 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8.</td>
                                                                    <td>fascia oraria 17-18</td>
                                                                    <td><span class="badge bg-success"><?php echo $S17_18 ?></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning mb-0">
                                <div class="inner">
                                    <h3><?php echo $kont_mm ?></h3>
                                    <p>Prenotazioni Mensili</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="card">

                                    <div id="accordion3">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapsetree" aria-expanded="false">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsetree" class="collapse" data-parent="#accordion3" style="">
                                                <div class="card">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-0">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Fascia oraria</th>
                                                                    <th style="width: 40px">totale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>fascia oraria 8-9</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M8_9 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2.</td>
                                                                    <td>fascia oraria 9-10</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M9_10 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3.</td>
                                                                    <td>fascia oraria 10-11</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M10_11 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4.</td>
                                                                    <td>fascia oraria 11-12</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M11_12 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5.</td>
                                                                    <td>fascia oraria 12-13</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M12_13 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6.</td>
                                                                    <td>fascia oraria 15-16</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M15_16 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7.</td>
                                                                    <td>fascia oraria 16-17</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M16_17 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8.</td>
                                                                    <td>fascia oraria 17-18</td>
                                                                    <td><span class="badge bg-warning"><?php echo $M17_18 ?></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger mb-0">
                                <div class="inner">
                                    <h3><?php echo $kont_aa ?></h3>
                                    <p>Prenotazioni Totali Annue</p>
                                </div>

                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>

                            </div>
                            <div class="w-100">
                                <div class="card">

                                    <div id="accordion4">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapsequattro" aria-expanded="false">
                                                        More info <i class="fas fa-arrow-circle-right"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapsequattro" class="collapse" data-parent="#accordion4" style="">
                                                <div class="card">

                                                    <!-- /.card-header -->
                                                    <div class="card-body p-0">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th>Fascia oraria</th>
                                                                    <th style="width: 40px">totale</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td>fascia oraria 8-9</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A8_9 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2.</td>
                                                                    <td>fascia oraria 9-10</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A9_10 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3.</td>
                                                                    <td>fascia oraria 10-11</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A10_11 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4.</td>
                                                                    <td>fascia oraria 11-12</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A11_12 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5.</td>
                                                                    <td>fascia oraria 12-13</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A12_13 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>6.</td>
                                                                    <td>fascia oraria 15-16</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A15_16 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>7.</td>
                                                                    <td>fascia oraria 16-17</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A16_17 ?></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>8.</td>
                                                                    <td>fascia oraria 17-18</td>
                                                                    <td><span class="badge bg-danger"><?php echo $A17_18 ?></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
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
                                                echo "<td style=\"padding: 0;\"> </td>\n"; //righe vuote

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

                                                        $day = "<a class=\"cal_red\" href=\"prenotazioni.php?day=$data\">$day</a>";
                                                    } else {

                                                        $day = "<a class=\"cal_green\" href=\"prenotazioni.php?day=$data\">$day</a>";
                                                    }
                                                } else {
                                                    $day = "<a class=\"cal_blue\" href=\"prenotazioni.php?day=$data\">$day</a>";
                                                }




                                                if ($data != $oggi) {
                                                    echo "<td style=\"padding: 0;\">" . $day . "</td>";
                                                } else {
                                                    echo "<td style=\"padding: 0;\"><b>" . $day . "</b></td>";
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
                                                <th style="width: 30%">
                                                    Prenotazione
                                                </th>
                                                <th style="width: 10%">
                                                    #ID
                                                </th>
                                                <th style="width: 25%">
                                                    Cliente
                                                </th>
                                                <th style="width: 25%">
                                                    Fascia oraria
                                                </th>
                                                <th style="width: 10%" class="text-center">
                                                    Check in
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $oggi = strtotime(date("Y-m-d"));
                                            include 'config.php';
                                            $sql = "SELECT p.id_prenotazione, p.str_data, p.fascia_oraria, a.nome_attivita , p.id_utente_prenotazione , u.nome , u.cognome ,p.presenza FROM prenotazioni as p join utenti as u on u.id_utente = p.id_utente_prenotazione join attivita as a on p.tipo_attivita = a.id_attivita WHERE p.str_data=$oggi and ( p.stato_prenotazione='intatta'or p.stato_prenotazione='modificata') order by p.fascia_oraria ";
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
                                                    $check = stripslashes($fetch['presenza']);
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
                    <div class="row">
                        <section class="col-lg-12 connectedSortable" style="background: #007bff;border-radius: 0.25rem;color: white;">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i> Cerca prenotazioni
                                </h3>

                                <!-- /. tools -->
                            </div>
                            <div class="card-body background: rgb(0 123 255);display: block;color: white;">

                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true" style="border: 1px solid white;">Tutte le prenotazioni</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false" style="border: 1px solid white;">Ricerca per data</a>
                                    </li>

                                </ul>
                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                        <form id="formAll" action="./ricerca.php" method="post">
                                            <div class="input-group mb-3">
                                                <input type="hidden" id="tutte" name="tutte" value="tutte" required>
                                            </div>
                                            <div class="row" style="border: 1px solid #fff;border-radius: 0.25rem;">
                                                <button type="submitAll" class="btn btn-primary btn-block w-100" name="register">Tutte le prenotazioni</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                        <form action="./ricerca.php" method="post">
                                            <div class="row " style="margin: auto;justify-content: center;">
                                                <div class=" col-6">
                                                    <label for=" dataDal">Dal</label>
                                                    <input type="date" class="form-control" placeholder="dataDal" name="dataDal" required>

                                                </div>
                                                <div class=" col-6" style="margin-bottom: 1rem;">
                                                    <label for="dataAl">Al</label>
                                                    <input type="date" class="form-control" placeholder="dataAl" name="dataAl" required>
                                                </div>
                                            </div>

                                            <div class="row" style="border: 1px solid #fff;border-radius: 0.25rem;">
                                                <button type="submitData" class="btn btn-primary btn-block w-100" name="register">Ricerca per data</button>
                                                <!-- /.col -->
                                            </div>
                                        </form>
                                    </div>

                                </div>


                                <hr>

                            </div>
                        </section>
                    </div>
                    <!-- /.cadird-header -->
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-header border-0">

                                <div class="card-tools">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="card-body" id="success">



                            </div>
                        </div>
                    </section>
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

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
        // Sales graph chart
    </script>


    <script>
        $("form").submit(function(event) {
            event.preventDefault(); //prevent default action 
            var post_url = $(this).attr("action"); //get form action url
            var request_method = $(this).attr("method"); //get form GET/POST method
            var form_data = $(this).serialize(); //Encode form elements for submission

            $.ajax({
                url: post_url,
                type: request_method,
                data: form_data
            }).done(function(response) { //
                $("#success").html(response);
            });
        });

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
    </script>

</body>

</html>