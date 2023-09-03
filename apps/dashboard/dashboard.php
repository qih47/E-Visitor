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


            <?php 
            $month = date('m');
$years = date('Y');
?>
            <section class="content">

                <div class="container-fluid">
<?php
include(__DIR__ . '../../tamu/monitoring.php');

?>
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
                                <h2 class="card-title">GRAFIK KUNJUNGAN PER TUJUAN BULAN <?= strtoupper($hari_indo) ?> TAHUN
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
                                <h2 class="card-title">GRAFIK KUNJUNGAN PER TUJUAN MULAI JANUARI - <?= strtoupper($hari_indo) ?>
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