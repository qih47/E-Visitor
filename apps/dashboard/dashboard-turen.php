        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><b>DASHBOARD</b></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>



            <section class="content">

                <div class="container-fluid">

                    <div class="row" id="total_kunjungan_hari">
                        <div class="col-3 ">

                            <div class="small-box bg-info">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitordir WHERE kartu_visitor LIKE ('%-H') AND date(jam_datang)=date(now())");
                                    $result1 = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('%-H') AND date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $sum = $row['total'];
                                    $sum1 = $row1['total'];
                                    ?>
                                    <h5><b>DATA HARI INI</b></h5>
                                    <p>Direktur Visitor | Sesper Visitor</p>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?>
                                        |
                                        <?php
                                        if ($sum1 < "1") {
                                            echo ("0");
                                        } else {
                                            echo ("$sum1");
                                        }
                                        ?>
                                    </h3>
                                    <h5><b>DATA BULAN INI</b></h5>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitordir WHERE kartu_visitor LIKE ('%-H') ");
                                    $result1 = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('%-H') ");
                                    $row = mysqli_fetch_assoc($result);
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $sum = $row['total'];
                                    $sum1 = $row1['total'];
                                    ?>
                                    <p>Direktur Visitor | Sesper Visitor</p>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?>| <?php
                                                if ($sum1 < "1") {
                                                    echo ("0");
                                                } else {
                                                    echo ("$sum1");
                                                }
                                                ?>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                                <a href="info_dir.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-3 ">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('KH%') AND date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <h5><b>DATA HARI INI</b></h5>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>

                                    <h5><b>DATA BULAN INI</b></h5>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('KH%') AND month(jam_datang)=month(now())");
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
                        <div class="col-3 ">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('K-%') AND date(jam_datang)=date(now())");
                                    $row = mysqli_fetch_assoc($result);
                                    $sum = $row['total'];
                                    ?>
                                    <h5><b>DATA HARI INI</b></h5>
                                    <h3> <?php
                                            if ($sum < "1") {
                                                echo ("0");
                                            } else {
                                                echo ("$sum");
                                            }
                                            ?> </h3>


                                    <h5><b>DATA BULAN INI</b></h5>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('K-%') AND month(jam_datang)=month(now())");
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
                        <div class="col-3">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h5><b>DATA HARI INI</b></h5>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('M%') AND date(jam_datang)=date(now())");
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


                                    <h5><b>DATA BULAN INI</b></h5>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitor WHERE kartu_visitor LIKE ('M%') AND month(jam_datang)=month(now())");
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
                </div>


                <div class="row">

                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <?php
                                date_default_timezone_set('Asia/Jakarta');

                                function getDayIndonesia($date)
                                {
                                    if ($date != '0000-00-00') {
                                        $data = hari(date('F', strtotime($date)));
                                    } else {
                                        $data = '-';
                                    }

                                    return $data;
                                }


                                function hari($day)
                                {
                                    $hari = $day;

                                    switch ($hari) {
                                        case "Jan":
                                            $hari = "JANUARI";
                                            break;
                                        case "Feb":
                                            $hari = "FEBRUARI";
                                            break;
                                        case "Mar":
                                            $hari = "MARET";
                                            break;
                                        case "Apr":
                                            $hari = "APRIL";
                                            break;
                                        case "May":
                                            $hari = "MEI";
                                            break;
                                        case "Jun":
                                            $hari = "JUNI";
                                            break;
                                        case "Jul":
                                            $hari = "JULI";
                                            break;
                                        case "Aug":
                                            $hari = "AGUSTUS";
                                            break;
                                        case "Sep":
                                            $hari = "SEPTEMBER";
                                            break;
                                        case "Oct":
                                            $hari = "OKTOBER";
                                            break;
                                        case "Nov":
                                            $hari = "NOVEMBER";
                                            break;
                                        case "Dec":
                                            $hari = "DESEMBER";
                                            break;
                                    }
                                    return $hari;
                                }


                                $tgl = date('F');
                                $hari_indo = getDayIndonesia($tgl);
                                $tahun = date('Y');
                                ?>
                                <h2 class="card-title">GRAFIK KUNJUNGAN PER TUJUAN BULAN <?= $hari_indo ?> TAHUN
                                    <?= $tahun ?> </h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <?php
                                    include("chart/chart-bulanan-divisi-bandung.php");
                                    ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- LINE CHART -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h2 class="card-title">GRAFIK KUNJUNGAN TAMU JANUARI - DESEMBER <?= $tahun ?></h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <?php
                                    include("chart/charts-kunjungan-bulanan-bandung.php");
                                    ?>
                                </div>
                            </div><br>

                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h2 class="card-title">GRAFIK KUNJUNGAN PER TUJUAN MULAI JANUARI - <?= $hari_indo ?>
                                    TAHUN
                                    <?= $tahun ?> </h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <?php
                                    include("chart/charts-kunjungan-tahunan-bandung.php");
                                    ?>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

        </div>

        </section>

        </div>

        </div>
        </section>

        </div>