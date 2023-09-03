<!DOCTYPE html>
<html lang="en" class="dark">
<title>E-VISITOR | RESEPSIONIS PINDAD</title>
<style>
    .even {
        background-color: black;
    }
</style>
<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/lib/lib-header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
$session_value = (isset($_SESSION['token'])) ? $_SESSION['token'] : '';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/policy/secure-pages.php';
$id = $_SESSION['idHal'];
$row = $database->getHalPath($id);
$keterangan = $row['ket'];


?>

<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
    <div class="wrapper">
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/viewres/sidebar.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/viewres/navbar.php';
        ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $keterangan ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?= $keterangan ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/' . $row['path'] . '.php';

            // MENU PAGES
            ?>
        </div>

        <!-- FOOTER -->
        <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/lib/lib-footer.php';
        ?>
        <!-- FOOTER -->
    </div>
</body>

</html>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
</script>