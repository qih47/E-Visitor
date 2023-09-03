                    <?php
                    $month = date('m');
                    $years = date('Y');
                    ?>
                    <section class="content">

                        <div class="container-fluid">
                            <div class="row" id="total_kunjungan_hari">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <?php
                                            $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitordir WHERE date(jam_datang)=date(now())");
                                            $result1 = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE  date(visitor.jam_datang)=date(now()) AND area.kode_area = 'H'");
                                            $result2 = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor  WHERE  date(visitor.jam_datang)=date(now()) AND keperluan = 'PRAKERIN'");
                                            $row = mysqli_fetch_assoc($result);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $sum = $row['total'];
                                            $sum1 = $row1['total'];
                                            $sum2 = $row2['total'];
                                            ?>
                                            <h5><b>DATA HARI INI</b></h5>
                                            <p>TAMU DIREKTUR | TAMU SESPER | PRAKERIN</p>
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
                                                ?>  |
                                                <?php
                                                if ($sum2 < "1") {
                                                    echo ("0");
                                                } else {
                                                    echo ("$sum2");
                                                }
                                                ?>
                                            </h3>
                                            <h5><b>DATA BULAN INI</b></h5>
                                            <?php
                                            $result = mysqli_query($conn, "SELECT SUM(total_visitor) AS total FROM visitordir WHERE month(jam_datang)='$month' AND year(jam_datang)='$years' ");
                                            $result1 = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE month(jam_datang)='$month' AND year(jam_datang)='$years' AND area.kode_area = 'H'");
                                            $result2 = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor  WHERE month(visitor.jam_datang)='$month' AND year(visitor.jam_datang)='$years' AND keperluan = 'PRAKERIN'");
                                            $row = mysqli_fetch_assoc($result);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $sum = $row['total'];
                                            $sum1 = $row1['total'];
                                            $sum2 = $row2['total'];
                                            ?>
                                            <p>TAMU DIREKTUR | TAMU SESPER | PRAKERIN</p>
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
                                                | <?php
                                                if ($sum2 < "1") {
                                                    echo ("0");
                                                } else {
                                                    echo ("$sum2");
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
                                            $result = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE  date(visitor.jam_datang)=date(now()) AND area.kode_area = 'KH'");
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
                                            $result = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE month(jam_datang)='$month' AND year(jam_datang)='$years' AND area.kode_area = 'KH'");
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
                                            $result = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE  date(visitor.jam_datang)=date(now()) AND area.kode_area = 'K'");
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
                                            $result = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE month(jam_datang)='$month' AND year(jam_datang)='$years' AND area.kode_area = 'K'");
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
                                            $result = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE  date(visitor.jam_datang)=date(now()) AND area.kode_area = 'M'");
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
                                            $result = mysqli_query($conn, "SELECT SUM(visitor.total_visitor) AS total FROM visitor JOIN divisi ON visitor.id_divisi = divisi.id JOIN area ON divisi.id_area = area.id WHERE month(jam_datang)='$month' AND year(jam_datang)='$years' AND area.kode_area = 'M'");
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