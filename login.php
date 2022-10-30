<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sportgym | Log in</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
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
    <style>
        .policy_privacy {
            background-color: powderblue;
            height: 100px; 
            position: absolute;
            border: solid;
            bottom: 0; 
            right: 0;  
            left: 0; 
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="./index2.html"><b>Sport</b>gym</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Accedi per avviare la tua sessione</p>
                <form action="./accedi.php" method="post">
                <?php
                    if(isset($_REQUEST["errpass"])|| isset($_REQUEST["errmail"]))
                    echo('<p style="color:red;">Email o password errata</p>');

                    if(isset($_REQUEST["timeout"]))
                echo ('<p style="color:red;">Sessione scaduta</p>');

                    ?>
                    <div class="input-group mb-3">
                        <input type="email" id="mail" name="mail" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="mx-auto">

                            <input type="submit" class="btn btn-primary btn-block" name="login" value="Sign in" />
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!--  <p class="mb-1">
                    <a href="#">Ho dimenticato la password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Registra un nuovo utente</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
    <!-- Pop up della privacy dela policy -->
    <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
            <div class="modal-content bg-primary">
                <div class="modal-header">
                    <h4 class="modal-title">Policy della privacy</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <p id="testo" class="p-3"></p>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal-dialog" id="modal-dialog"></div>  
    <div class="policy_privacy">
    <h1 >Per consultare la policy della privacy del sito, clicca il bottone sottostante</h1>
    <button  onclick="setform()" class="modal-message" data-toggle="modal" data-target="#modal-primary" >Leggi documento</button>
    </div>
    <script>
        function setform() {
            let contenuto = 'Non so fare niente';
            document.getElementById('testo').innerHTML = '<iframe id="myFrame" src="./privacy-policy.html" width="450" height="500"></iframe>';
        }
    </script>
</body>

</html>