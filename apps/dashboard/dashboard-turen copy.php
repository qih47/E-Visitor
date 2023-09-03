<?php include("header.php");
include("config/koneksi.php");
date_default_timezone_set('Asia/Jakarta');

?>
<title>E-VISITOR | Dashboard</title>
<style>
td {
    font-size: 16px;
    line-height:35px;
}
</style>
<style>
.garis_tepi1 {
    border: 4px solid black;
}

.garis_tepi2 {
    border: 3px solid black;
    height: 461px;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include("navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php   if ($_SESSION['level'] == 'super_admin'){
            include("side_menu_superadmin.php");
        }else{
            include("side_menu_turen.php");  
        }  
            ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-1">
                            <select class="form-control" id="kunjungan">
                                <option value="hari">Hari ini</option>
                                <option value="bulan">Bulan ini</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" style="display: block;" id="total_kunjungan_hari">
                        <h1>Hari ini</h1>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <p>Visitor Hari ini</p>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>
                                  
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="info_dir.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-KH') AND date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>

                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>

                                    <p>Green Zone Visitor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_green.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-K') AND date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>


                                    <p>Yellow Zone Visitor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_yellow.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-M') AND date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>


                                    <p>Red Zone Visitor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_red.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <div class="row" style="display: none;" id="total_kunjungan_bulan">
                        <h1>Bulan ini</h1>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                            <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitordir WHERE kartu_visitor LIKE ('%-H') ");
                                    $result1 = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-H') ");
                                    $row = mysqli_fetch_assoc($result);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $sum = $row['total'];
                                    $sum1 = $row1['total'];
                                    ?>
                                    <p>Direktur Visitor</p>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>
                                    <p>Sesper Visitor</p>
                                    <h3> <?php
                                            if ($sum1 < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum1");
                                            }
                                            ?> </h3>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_dir.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-KH') AND month(jam_datang)=month(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>

                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>

                                    <p>Green Zone Visitor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_green.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-K') AND month(jam_datang)=month(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>


                                    <p>Yellow Zone Visitor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_yellow.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor_turen WHERE kartu_visitor LIKE ('%-M') AND month(jam_datang)=month(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>


                                    <p>Red Zone Visitor</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_red.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <center>
                        <h2><b>KUNJUNGAN TERBARU </b></h2>
                    </center>
                    <div class="row">
                        <div class="col-lg-4 " style="margin-left: 36.5%">
                            <?php
                            $sql_lastinput = mysqli_query($conn, "SELECT visitor_turen.*, no_rfid ,divisi_turen.nama_divisi FROM visitor_turen LEFT JOIN divisi_turen ON visitor_turen.id_divisi = divisi_turen.id JOIN area ON area.id = divisi_turen.id_area JOIN kartu_turen ON kartu_turen.id_area = area.id WHERE date(jam_datang)=date(now()) GROUP BY (visitor_turen.id) ORDER BY id DESC LIMIT 1");
                            while ($data_visitor = $sql_lastinput->fetch_assoc()) {
                            ?>
                            <div style="width: 470px; height: 530px; border: 3px solid black">
                                <div class="garis_tepi1">
                                    <img src="asset/img/logo_pindad.png " alt="PAM" align="left" class="ml-2 mt-3"
                                        width="50px" height="35px">
                                    <img src="asset/img/iso.png " alt="PAM" align="right" class="mr-2 mt-3" width="50px"
                                        height="35px">
                                    <p align="center" class="mr-3 mt-2" width="70px" height="50px"><b>PT.PINDAD
                                            (PERSERO)<br>DIVISI PENGAMANAN DAN PENGELOLAAN ASET</b></p>
                                </div>
                                <div class="garis_tepi2">
                                    <center>
                                        <h3><b><u>VISITOR UMUM</b></u></h3>
                                    </center>

                                    <table style="margin: 20px; " class="mt-2">
                                        <tr>
                                            <td><b>Nama</b></td>
                                            <td>&nbsp:&nbsp </td>
                                            <td><?= $data_visitor['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Visitor</b></td>
                                            <td>&nbsp:&nbsp </td>
                                            <td><?= $data_visitor['total_visitor'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Instansi</b></td>
                                            <td>&nbsp:&nbsp </td>
                                            <td><?= $data_visitor['instansi'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td>&nbsp:&nbsp</td>
                                            <td><?= $data_visitor['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Orang Dituju</b> </td>
                                            <td>&nbsp:&nbsp</td>
                                            <td><?= $data_visitor['orang_dituju'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Divisi</b></td>
                                            <td>&nbsp:&nbsp</td>
                                            <td><?= $data_visitor['nama_divisi'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Keperluan</b></td>
                                            <td>&nbsp:&nbsp</td>
                                            <td><?= $data_visitor['keperluan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Jam Datang</b></td>
                                            <td>&nbsp:&nbsp</td>
                                            <td><?= date_format(date_create($data_visitor['jam_datang']), "H:i:s"); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Lain-Lain</b></td>
                                            <td>&nbsp:&nbsp</td>
                                            <td><?= $data_visitor['kendaraan'] ?></td>
                                        </tr>
                                    </table>
                                    
                                </div>
                                <div class="row ml-0 mt-3">
                                <a href="print_tamu.php?id=<?=$data_visitor['id'];?>&nama_divisi=<?= $data_visitor['nama_divisi']; ?>" name="print" target="_blank" value="PRINT" class="btn btn-primary"><i
                            class="fas fa-print pr-2"></i>PRINT</a>
                            </div>
                            </div>
                        </div>

                        <!-- <div class="row"> -->



                        <?php
                            }
                    ?>
                    </div>
                </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include("footer.php") ?>
</body>

</html>
<script>
$('#kunjungan').on('change', function() {

    if (this.value == 'hari') {
        $("#total_kunjungan_hari").css("display", "block");
        $("#total_kunjungan_bulan").css("display", "none");
    } else if (this.value == 'bulan') {
        $("#total_kunjungan_hari").css("display", "none");
        $("#total_kunjungan_bulan").css("display", "block");
    }
});
</script>