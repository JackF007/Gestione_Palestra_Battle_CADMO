        <?php

        if (!(isset($_POST['ricerca'])) && (isset($_GET['day']) && is_numeric($_GET['day']))) { // passaggio valori automatici
            $day = $_GET['day'];
            include 'config.php';
            $sql = "SELECT COUNT(*) FROM prenotazioni WHERE str_data=$day"; //count su
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {

                if ($row[0] < 8) {
                    $m = (date("m", (int)$_GET['day']));
                    $y = (date("Y", (int)$_GET['day']));
                    $d  = (date("d", (int)$_GET['day']));
                } else {
                    header("location:dashboard.php");
                }
            }
        }
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
                                                    <select class="form-control select2" name"fascia" style="width: 100%;" required>
                                                        <option>Alabama</option>
                                                        <option>Alaska</option>
                                                        <option>California</option>
                                                        <option>Delaware</option>
                                                        <option>Tennessee</option>
                                                        <option>Texas</option>
                                                        <option>Washington</option>
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
                                                                    <th>Rendering engine</th>
                                                                    <th>Browser</th>
                                                                    <th>Platform(s)</th>
                                                                    <th>Engine version</th>
                                                                    <th>seleziona</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Trident</td>
                                                                    <td>Internet
                                                                        Explorer 4.0
                                                                    </td>
                                                                    <td>Win 95+</td>
                                                                    <td> <input name="titolo" type="hidden" value"id" placeholder="cccc"></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                                                                            Launch Primary Modal
                                                                        </button>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Trident</td>
                                                                    <td>Internet
                                                                        Explorer 5.0
                                                                    </td>
                                                                    <td>franco
                                                                    </td>
                                                                    <td><input name="titolo" type="text" value"ciao"></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                                                                            Launch Primary Modal
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Trident</td>
                                                                    <td>Internet
                                                                        Explorer 4.0
                                                                    </td>
                                                                    <td>francesco</td>
                                                                    <td> <input type="text" name="titolo" class="form-control" value="<?php echo $d . "/" . $m . "/" . $y ?>" disabled></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                                                                            Launch Primary Modal
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Trident</td>
                                                                    <td>Internet
                                                                        Explorer 5.0
                                                                    </td>
                                                                    <td>marco</td>
                                                                    <td><input type="text" name="titolo" class="form-control" value="<?php echo $d . "/" . $m . "/" . $y ?>" disabled></td>
                                                                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
                                                                            Launch Primary Modal
                                                                        </button></td>
                                                                </tr>

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                                <div class="modal fade" id="modal-primary">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-primary">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Conferma Prenotazione</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-footer justify-content-between">

                                                                <button name="invia-prenotazione" type="submit" class="btn btn-outline-light  w-100" value="invia">Registra Prenotazione</button>
                                                            </div>
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
                <strong>Copyright &copy; 2022 SportGym .</strong> All rights reserved.
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>

            <!-- jQuery -->
            <script src="./plugins/jquery/jquery.min.js"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- jQuery -->
            <script src="./plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- DataTables  & Plugins -->
            <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
            <!-- Bootstrap4 Duallistbox -->
            <script src="./plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
            <!-- InputMask -->
            <script src="./plugins/moment/moment.min.js"></script>
            <script src="./plugins/inputmask/jquery.inputmask.min.js"></script>
            <!-- date-range-picker -->
            <script src="./plugins/daterangepicker/daterangepicker.js"></script>
            <script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>



            <script src="./dist/js/adminlte.min.js"></script>

            <!-- Page specific script -->
            <script>
                $(function() {
                    $("#example1").DataTable({

                        "zeroRecords": "No records to display",
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "pageLength": 1

                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



                });


                $(function() {


                    //Datemask dd/mm/yyyy
                    $('#datemask').inputmask('dd/mm/yyyy', {
                        'placeholder': 'dd/mm/yyyy'
                    })

                    //Money Euro
                    $('[data-mask]').inputmask()


                    //Timepicker
                    $('#timepicker').datetimepicker({
                        format: 'LT'
                    })




                })
            </script>

        </body>

        </html>