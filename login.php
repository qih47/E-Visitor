<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receptionis | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box ">
        <center>
            <div class="login-logo">
                <img src="assets/img/evisitor.png " alt="PAM" width="170px" height="120">
            </div>
            <h2><b>DIVISI PENGAMANAN</b></h2>
        </center><br>
        <?php
        require_once "system/config/policy/session-token-expired.php";

        // session_start();
        // echo $_SESSION['token'];
        if (isset($_SESSION['token'])) {
            echo "<div class='alert alert-success'><i class='fas fa-user pr-2 px-2'><strong> Hallo, $_SESSION[nama]</strong></i><i class='fa fa-sync float-right fa-spin'></i></div>";

            echo '<script>setTimeout(function () {
                window . location . href = "pages/controllers/index/hal.php?i=pages1";
            }, 2000); </script>';
        } else {
            echo "<div id='alert' name='alert' class='alert alert-success'><strong>Selamat Datang, Silahkan Login..!!</strong></div>";
        }
        ?>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">SILAHKAN LOGIN DULU</p>

                <form action="system/sys-login/cek-login.php?" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="npp" class="form-control" placeholder="NPP / Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign In">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
            <?php

            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "salah") {
                    echo "<div class='alert alert-warning'><strong>UPSS !</strong> Kayanya Password atau npp salah!</div>";
                }
                if ($_GET['pesan'] == "nouser") {
                    echo "<div class='alert alert-warning'><strong>UPSS !</strong> Kayanya user tidak ditemukan!</div>";
                }
                if ($_GET['pesan'] == "gagal") {
                    echo "<div class='alert alert-warning'><strong>UPSS !</strong> Gagal Login silahkan cobalagi..!!</div>";
                }
            }

            ?>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/adminlte.min.js"></script>
</body>

</html>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
</script>