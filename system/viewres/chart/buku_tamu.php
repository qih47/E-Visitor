<?php include("header.php") ?>
<title>E-VISITOR | Buku Tamu</title>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include("navbar.php");
        include("config/koneksi.php");
        date_default_timezone_set('Asia/Jakarta');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php if ($_SESSION['level'] == 'super_admin') {
            include("side_menu_superadmin.php");
        } else {
            include("side_menu.php");
        }
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- /.content-header -->

            <!-- Main content -->

            <div class="m-6 mt-1">
                <?php include("monitoring.php"); ?>
                <div class="row ml-0 ">
                    <span class="btn btn-primary pull-right button mt-4 mb-3" id="tambah-tamu"><i
                            class="fas fa-user-plus pr-2 "></i>Tambah Visitor</span>
                    <span class="btn btn-primary pull-right button mt-4 ml-2 mb-3" id="downloadlaporanbtn"><i
                            class="fas fa-file-excel pr-2"></i>Laporan Kunjungan</span>
                </div>
                <div class="row mt-4 mb-3 hidden" id="form_bulan_download">
                    <?php $month = date('Y-m'); ?>
                    <div class="col-2 ml-2">
                        <input type="month" id="monthdownload" name="month" class="form-control" value="<?= $month; ?>">
                    </div>
                    <div class="col-2">
                        <span class="btn btn-primary button mt-2 " id="downloadlaporan"><i
                                class="fas fa-file-download pr-2"></i>Download Laporan</span>
                        <span onclick="location.href='laporan_perhari.php'" class="btn btn-primary button mt-2 "
                            id="laporanperhari"><i class="fas fa-file-download pr-2"></i>Laporan Hari Ini</span>
                    </div>
                </div>
                <div class="row ml-3 hidden" id="tamus">
                    <span class="r-2 btn btn-primary pull-right button mr-2" id="btn-tamu-umum"><i
                            class="fas fa-user pr-2"></i>Tamu Umum</span>
                    <span class="r-2 btn btn-primary pull-right button mr-2" id="btn-tamu-direktur"><i
                            class="fas fa-user-tie pr-2"></i>Tamu Direktur</span>
                    <span class="r-2 btn btn-primary pull-right button" id="btn-tamu-pkl"><i
                            class="fas fa-user-graduate pr-2"></i>PKL / MAGANG</span>
                </div>
                </nav>
                <?php

                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "selesai") {
                        echo "<div class='alert alert-success alert-dismissible ' id='success-alerts'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h5><i class='icon fas fa-check'></i> KUNJUNGAN SELESAI!</h5>
    Pengunjung Telah Selesai Berkunjung!
</div>";
                    }

                    if ($_GET['pesan'] == "dihapus") {
                        echo "<div class='alert alert-success alert-dismissible ' id='success-alerts'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h5><i class='icon fas fa-check'></i> DATA DIHAPUS!</h5>
    Data Telah Berhasil Dihapus!
</div>";
                    }

                    if ($_GET['pesan'] == "print") {
                        echo "<div class='alert alert-success alert-dismissible ' id='success-alerts'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h5><i class='icon fas fa-check'></i> CETAK!</h5>
    Bukti Kunjungan Tamu Akan Dicetak!
</div>";
                    }
                }

                ?>
                <div class="alert alert-success alert-dismissible hidden" id="success-alerts">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> SUCCESS!</h5>
                    Data Pengunjung Berhasil Ditambah.!
                </div>
                <div class="alert alert-danger alert-dismissible hidden" id="danger-alerts">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> GAGAL!</h5>
                    Data Pengunjung Tidak Berhasil Ditambah.!
                </div>
                <!-- form start -->
                <form action="?" method="post" id="tamu-umum-form" class="hidden">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Pengunjung</label>
                            <div class="input-group control-group ">
                                <input type="text" name="addmore[]" class="form-control"
                                    placeholder="Masukan Nama Pengunjung" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-more" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add</button>
                                </div>
                            </div>
                            <div class="after-add-more">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Instansi</label>
                            <input type="text" name="instansi" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                    <label for="">Total Visitor</label>
                    <input type="text" name="total" class="form-control">
                  </div> -->
                        <div class="form-group">
                            <label for="">Orang Yang Dituju</label>
                            <input type="text" name="orang_dituju" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Divisi </label>
                            <select class="form-control" name="divisi" id="divisi">
                                <option> Pilih Divisi</option>
                                <?php
                                $sql = "SELECT * FROM divisi";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?= $row["id"] ?>"> <?= $row["kode_divisi"] ?> (
                                    <?= $row["nama_divisi"] ?> ) </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kartu Visitor </label>
                            <select class="form-control" name="kartu" id="kartuUmum">
                                <option> Pilih Nomor Kartu</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Keperluan</label>
                            <input type="text" name="keperluan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="vehicle" name="vehicle" value="Bike">
                            <label for="vehicle"> Ada Izin Kendaraan atau lainnya?</label>
                        </div>
                        <div class="form-group" id="kendaraan">
                            <label for="">Keterangan Lain-lain</label>
                            <div class="input-group control-group ">
                                <input type="text" name="addmore-kendaraan[]" class="form-control"
                                    placeholder="Masukan Nama Kendaraan dan Plat Nomor Kendaraan atau Izin Lain">
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-more-kendaraan" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add</button>
                                </div>
                            </div>
                            <div class="after-add-more-kendaraan">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="submit" name="submitUmum" value="Submit" class="btn btn-primary">
                    </div>
                </form>

                <form action="?" method="post" id="tamu-direktur-form" class="hidden">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Pengunjung</label>
                            <div class="input-group control-group ">
                                <input type="text" name="addmore-dir[]" class="form-control"
                                    placeholder="Masukan Nama Pengunjung" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-more-dir" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add</button>
                                </div>
                            </div>
                            <div class="after-add-more-dir">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Instansi</label>
                            <input type="text" name="instansi" class="form-control" require>
                        </div>
                        <!-- <div class="form-group">
                    <label for="">Total Visitor</label>
                    <input type="text" name="total" class="form-control">
                  </div> -->
                        <div class="form-group">
                            <label for="">Direktur </label>
                            <select class="form-control" name="dir" id="dir">
                                <option> Pilih Direktur</option>
                                <?php
                                $sql = "SELECT * FROM direktur";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?= $row["id"] ?>"> <?= $row["kode_dir"] ?> (
                                    <?= $row["jabatan"] ?> ) </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Direktur</label>
                            <input type="text" class="form-control" name="dir_name" id="dir_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Kartu Visitor </label>
                            <select class="form-control" name="kartu" id="kartuDir">
                                <option> Pilih Nomor Kartu</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Keperluan</label>
                            <input stype="text" name="keperluan" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike1">
                            <label for="vehicle1"> Ada Izin Kendaraan atau lainnya?</label>
                        </div>
                        <div class="form-group" id="kendaraan1">
                            <label for="">Keterangan Lain-lain</label>
                            <div class="input-group control-group ">
                                <input type="text" name="addmore-kendaraan1[]" class="form-control"
                                    placeholder="Masukan Nama Kendaraan dan Plat Nomor Kendaraan atau Izin Lain">
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-more-kendaraan1" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add</button>
                                </div>
                            </div>
                            <div class="after-add-more-kendaraan1">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="submit" name="submitDirektur" value="Submit" class="btn btn-primary"
                            href="print_tamu.php?id=<?= $data_visitor['id']; ?>&nama_divisi=<?= $data_visitor['nama_divisi']; ?>"
                            target="_blank">
                    </div>
                </form>

                <form action="?" method="post" id="tamu-pkl-form" class="hidden">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Pelajar / Mahasiswa</label>
                            <div class="input-group control-group ">
                                <input type="text" name="addmore-pkl[]" class="form-control"
                                    placeholder="Masukan Nama Pelajar / Mahasiswa" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-more-pkl" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add</button>
                                </div>
                            </div>
                            <div class="after-add-more-pkl">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Sekolah / Universitas</label>
                            <input type="text" name="sekolah" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                    <label for="">Total Visitor</label>
                    <input type="text" name="total" class="form-control">
                  </div> -->
                        <div class="form-group">
                            <label for="">Nama Pembimbing</label>
                            <input type="text" name="pembimbing" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Divisi </label>
                            <select class="form-control" name="divisi-pkl" id="divisi-pkl">
                                <option> Pilih Divisi</option>
                                <?php
                                $sql = "SELECT * FROM divisi";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <option value="<?= $row["id"] ?>"> <?= $row["kode_divisi"] ?> (
                                    <?= $row["nama_divisi"] ?> ) </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kartu Prakerin </label>
                            <select class="form-control" name="kartu-pkl" id="kartu-pkl">
                                <option> Pilih Nomor Kartu</option>

                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label for="">Keperluan</label>
                            <input type="text" name="keperluan" class="form-control" required>
                        </div> -->
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" name="alamat-pkl" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="vehicle-pkl" name="vehicle-pkl" value="Bike">
                            <label for="vehicle"> Ada Izin Kendaraan atau lainnya?</label>
                        </div>
                        <div class="form-group" id="kendaraan-pkl">
                            <label for="">Keterangan Lain-lain</label>
                            <div class="input-group control-group ">
                                <input type="text" name="addmore-kendaraan-pkl[]" class="form-control"
                                    placeholder="Masukan Nama Kendaraan dan Plat Nomor Kendaraan atau Izin Lain">
                                <div class="input-group-btn">
                                    <button class="btn btn-success add-more-kendaraan-pkl" type="button"><i
                                            class="glyphicon glyphicon-plus"></i> Add</button>
                                </div>
                            </div>
                            <div class="after-add-more-kendaraan-pkl">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input type="submit" name="submitpkl" value="Submit" class="btn btn-primary">
                    </div>
                </form>
                <br><br>
                <h1 class="row m-0">Data Kunjungan</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-sm rowTipis" id="tableTamuum">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Instansi</th>
                                <th scope="col">Total Visitor</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Keperluan</th>
                                <th scope="col">Tujuan</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Jam Datang</th>
                                <th scope="col">Jam Keluar</th>
                                <th scope="col">Ran/Laptop</th>
                                <th scope="col">Aksi</th>
                                <th scope="col" style="display:none"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- List Data Menggunakan DataTable -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include("footer.php") ?>

        <script>
        $(document).ready(function() {
            $('#tableTamuum').DataTable({
                "processing": true,
                "serverSide": true,
                "sPaginationType": "full_numbers",
                "ajax": "ajaxfile.php",

                "order": [],
                "fnCreatedRow": function(row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                },

                "columnDefs": [{

                        "searchable": false,
                        "data": null,
                        "targets": [11],
                        "width  ": "8%",

                        "render": function(data, dt, ids, type, row) {
                            var indexID = data[0];
                            var indexNama = data[1];
                            var tujuan = data[7];
                            var btn = "<center><a href=\"print_tamu.php?id=" + indexID +
                                "&nama_divisi=" + tujuan +
                                "\"class=\"btn btn-success btn-xs \" target=\"_blank\"><i class=\"glyphicon glyphicon-print\"></i></a> <a href=\"selesai.php?id=" +
                                data[0] +
                                "\"class=\"btn btn-warning btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a> <a href=\"del.php?id=" +
                                data[0] +
                                "\"onclick=\"return confirm('Anda Yakin Ingin Menghapus Data " +
                                indexID + " dengan nama " + indexNama +
                                "')\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-trash\"></i></a></center>";
                            return btn;
                        }
                    },
                    {
                        "targets": [12],
                        "visible": false
                    },
                    {
                        "targets": [1],
                        "width": "20%"
                    }
                ]
            });

        });
        </script>
        <!-- <script>
        function deleteConfirm(db, ids, names) {
            // console.log(id);
            var indexID = ids;
            var indexNama = names;
            swal({
                    title: "Anda yakin ingin menghapus data ini?",
                    text: "Data dengan id " + indexID + " atas nama " + indexNama + " akan di hapus",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = '?deleteid=' + indexID + '';
                        table.clear();
                        table.ajax.reload();
                        table.draw();
                    } else {
                        // swal("Data id "+indexID+" dengan nama "+indexNama+" tidak dihapus");
                        swal({
                            text: 'Data id ' + indexID + ' dengan nama ' + indexNama + ' tidak dihapus',
                            icon: 'info',
                            type: 'success',
                            button: true
                        });
                    }
                });
        }
        </script> -->
        <script>
        $('#form_bulan_download').removeClass('hidden');
        $('#form_bulan_download').hide();
        $('#downloadlaporanbtn').on('click', function() {
            $('#form_bulan_download').toggle();
        });

        $('#downloadlaporan').on('click', function() {
            var bulanTahun = $('#monthdownload').val();

            var tahun = bulanTahun.substring(0, 4);
            var bulan = bulanTahun.substring(5);
            var page = "export_excel.php?bulan=" + bulan + "&tahun=" + tahun + "";
            $.ajax({
                url: page,

                method: "GET",
                success: function(response) {
                    window.location = page;
                },
                error: function() {
                    alert("gagal export");
                }

            });

        });
        </script>


        <script>
        $('#tamus').removeClass('hidden');
        $('#tamu-direktur-form').hide();
        $('#tamu-umum-form').hide();
        $('#tamu-pkl-form').hide();
        $('#btn-tamu-direktur').hide();
        $('#btn-tamu-umum').hide();
        $('#btn-tamu-pkl').hide();
        $('#tambah-tamu').on('click', function() {
            $('#btn-tamu-direktur').toggle();
            $('#btn-tamu-umum').toggle();
            $('#btn-tamu-pkl').toggle();
            $('#tamu-umum-form').removeClass('hidden');
            $('#tamu-umum-form').toggle();
            $('#form_bulan_download').hide();
        });
        $('#btn-tamu-umum').on('click', function() {
            $('#tamu-umum-form').show();
            $('#tamu-direktur-form').hide();
            $('#tamu-pkl-form').hide();
        });
        $('#btn-tamu-direktur').on('click', function() {
            $('#tamu-umum-form').hide();
            $('#tamu-pkl-form').hide();
            $('#tamu-direktur-form').removeClass('hidden');
            $('#tamu-direktur-form').show();
        });
        $('#btn-tamu-pkl').on('click', function() {
            $('#tamu-pkl-form').show();
            $('#tamu-pkl-form').removeClass('hidden');
            $('#tamu-direktur-form').hide();
            $('#tamu-umum-form').hide();
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more-um").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore[]" class="form-control" placeholder="Masukan Nama Pengunjung"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more").append(html);
            });
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more-dir").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore-dir[]" class="form-control" placeholder="Masukan Nama Pengunjung"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more-dir").append(html);
            });
            $("body").on("click", ".remove-dir", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more-pkl").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore-pkl[]" class="form-control" placeholder="Masukan Nama Pelajar / Mahasiswa"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more-pkl").append(html);
            });
            $("body").on("click", ".remove-pkl", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more-kendaraan").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore-kendaraan[]" class="form-control" placeholder="Masukan Nama Kendaraan dan Plat Nomor Kendaraan atau Izin Lain"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more-kendaraan").append(html);
            });
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more-kendaraan1").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore-kendaraan1[]" class="form-control" placeholder="Masukan Nama Kendaraan dan Plat Nomor Kendaraan atau Izin Lain"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more-kendaraan1").append(html);
            });
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more-kendaraan-pkl").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore-kendaraan-pkl[]" class="form-control" placeholder="Masukan Nama Kendaraan dan Plat Nomor Kendaraan atau Izin Lain"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more-kendaraan-pkl").append(html);
            });
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#divisi').on('change', function() {
                $('#kartuUmum').empty();
                var id_divisi = this.value;
                $.get("get_kartu.php", {
                    id: id_divisi
                }, function(data) {
                    var kartu = JSON.parse(data);
                    $.each(kartu, function(index, value) {
                        $('#kartuUmum').append($("<option></option>")
                            .attr("value", value)
                            .text(value));
                    });
                });
            });
        });
        </script>

        <script>
        $('#kendaraan').hide();
        $('#vehicle').change(function() {
            if (this.checked != true) {
                $("#kendaraan").hide();
            } else {
                $("#kendaraan").show();
            }
        });
        </script>
        <script>
        $('#kendaraan1').hide();
        $('#vehicle1').change(function() {
            if (this.checked != true) {
                $("#kendaraan1").hide();
            } else {
                $("#kendaraan1").show();
            }
        });
        </script>
        <script>
        $('#kendaraan-pkl').hide();
        $('#vehicle-pkl').change(function() {
            if (this.checked != true) {
                $("#kendaraan-pkl").hide();
            } else {
                $("#kendaraan-pkl").show();
            }
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more").click(function() {
                var html =
                    '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore[]" class="form-control" placeholder="Masukan Nama Pengunjung"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button> </div> </div>';
                $(".after-add-more").append(html);
            });
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('#dir').on('change', function() {
                $('#dir_name').empty();
                var id = this.value;
                $.get("get_dir.php", {
                    id: id
                }, function(data) {
                    var nama_direktur = data;
                    $('#dir_name').val(nama_direktur.trim());
                });
            });
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#dir').on('change', function() {
                $('#kartuDir').empty();
                var id = this.value;
                $.get("get_kartu_direktur.php", {
                    id: id
                }, function(data) {
                    var kartu = JSON.parse(data);
                    $.each(kartu, function(index, value) {
                        $('#kartuDir').append($("<option></option>")
                            .attr("value", value)
                            .text(value));
                    });
                });
            });
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#divisi-pkl').on('change', function() {
                $('#kartu-pkl').empty();
                var id = this.value;
                $.get("get_kartu_pkl.php", {
                    id: id
                }, function(data) {
                    var kartu = JSON.parse(data);
                    $.each(kartu, function(index, value) {
                        $('#kartu-pkl').append($("<option></option>")
                            .attr("value", value)
                            .text(value));
                    });
                });
            });
        });
        </script>
</body>
<?php
// if (isset($_GET["deleteid"])  ||  isset($_GET["selesai"])) {
//     $editid = $_GET["selesai"];
//     $deleteid = $_GET["deleteid"];
//     $jamkeluar = date('Y-m-d H:i:s');
//     $editselectid = mysqli_query($conn, "UPDATE visitor SET jam_keluar='$jamkeluar' WHERE id=$editid ");
//     $editselectid = mysqli_query($conn, "UPDATE visitordir SET jam_keluar='$jamkeluar' WHERE id=$editid");
//     $deleteselectid = mysqli_query($conn, "DELETE FROM visitor WHERE id=$deleteid");
//     $deleteselectid = mysqli_query($conn, "DELETE FROM visitordir WHERE id=$deleteid");

//     if ($editselectid == true or $editselectiddir == true) {
//         echo "<script>swal({title: 'Selesai', text: 'Visitor telah selesai berkunjung!',icon:'success', type: 'success',button:false,timer:2000});</script>";
//     }
//     if ($deleteselectid == true or $deleteselectiddir == true) {
//         echo "<script>swal({title: 'Sukses', text: 'Data visitor berhasil dihapus!',icon:'success', type: 'success',button:false,timer:1000});</script>";
//     }
// }

if (isset($_POST['submitUmum'])) {

    $divisi = $_POST['divisi'];
    $orang_dituju = $_POST['orang_dituju'];
    $keperluan = $_POST['keperluan'];
    $input = $_POST['addmore'];
    $total_visitor = count($input);
    $instansi = $_POST['instansi'];
    $kartu_visitor = $_POST['kartu'];
    $jam_datang = date('Y-m-d H:i:s');
    $alamat = $_POST['alamat'];
    $ket = strtoupper($_SESSION['nama']);
    $nama_visitor = join(",", $input);
    $inputvehicle = $_POST['addmore-kendaraan'];
    $kendaraan = join(",", $inputvehicle);
    $sql1 = "INSERT INTO visitor (id,nama, total_visitor, keperluan, orang_dituju,  instansi, jam_datang, kartu_visitor, id_divisi, alamat,kendaraan,keterangan) 
    VALUES(NULL,'$nama_visitor', '$total_visitor', '$keperluan', '$orang_dituju','$instansi', '$jam_datang' , '$kartu_visitor' ,'$divisi','$alamat', '$kendaraan','$ket')";
    if (mysqli_query($conn, $sql1)) {
        echo "<script>$('#success-alerts').removeClass('hidden');</script>";
    } else {
        echo "<script>$('#danger-alerts').removeClass('hidden');</script>";
    }
    foreach ($input as $output) {
        $sql = "INSERT INTO visitor_history (id,nama, total_visitor, keperluan, orang_dituju,  instansi, jam_datang, kartu_visitor, id_divisi, alamat) 
  VALUES(NULL,'$output', '$total_visitor', '$keperluan', '$orang_dituju','$instansi', '$jam_datang' , '$kartu_visitor' ,'$divisi','$alamat')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>$('#success-alerts').removeClass('hidden');</script>";
        } else {
            echo "<script>$('#danger-alerts').removeClass('hidden');</script>";
        }
    }
}

if (isset($_POST['submitDirektur'])) {
    $dir = $_POST['dir'];
    $orang_dituju = $_POST['dir_name'];
    $keperluan = $_POST['keperluan'];
    $input = $_POST['addmore-dir'];
    $total_visitor = count($input);
    $instansi = $_POST['instansi'];
    $kartu_visitor = $_POST['kartu'];
    $jam_datang = date('Y-m-d H:i:s');
    $alamat = $_POST['alamat'];
    $nama_visitor = join(",", $input);
    $inputkendaraan = $_POST['addmore-kendaraan1'];
    $kendaraandir = join(",", $inputkendaraan);



    $sql = "INSERT INTO visitordir (id,nama, total_visitor, keperluan, orang_dituju,  instansi, jam_datang, kartu_visitor, id_direktur, alamat, kendaraan) 
  VALUES(NULL,'$nama_visitor', '$total_visitor', '$keperluan', '$orang_dituju','$instansi', '$jam_datang' , '$kartu_visitor' ,'$dir','$alamat', '$kendaraandir')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>$('#success-alerts').removeClass('hidden');</script>";
        // echo "<script>alert('data ditambahkan');</script>";
    } else {
        echo "<script>$('#danger-alerts').removeClass('hidden');</script>";
    }

    foreach ($input as $output) {
        $sql2 = "INSERT INTO visitordir_history (id,namad, total_visitor, keperluan, orang_dituju_d,  instansi, jam_datang, kartu_visitor, id_direktur, alamat) 
  VALUES(NULL,'$output', '$total_visitor', '$keperluan', '$orang_dituju','$instansi', '$jam_datang' , '$kartu_visitor' ,'$dir','$alamat')";

        if (mysqli_query($conn, $sql2)) {
            echo "<script>$('#success-alerts').removeClass('hidden');</script>";
            // echo "<script>alert('data ditambahkan');</script>";
        } else {
            echo "<script>$('#danger-alerts').removeClass('hidden');</script>";
        }
    }
}

if (isset($_POST['submitpkl'])) {

    $divisi = $_POST['divisi-pkl'];
    $orang_dituju = $_POST['pembimbing'];
    $keperluan = "PRAKERIN";
    $input = $_POST['addmore-pkl'];
    $total_visitor = count($input);
    $instansi = $_POST['sekolah'];
    $kartu_visitor = $_POST['kartu-pkl'];
    $jam_datang = date('Y-m-d H:i:s');
    $alamat = $_POST['alamat-pkl'];
    $ket = strtoupper($_SESSION['nama']);
    $nama_visitor = join(",", $input);
    $inputvehicle = $_POST['addmore-kendaraan-pkl'];
    $kendaraan = join(",", $inputvehicle);
    $sqlpkl = "INSERT INTO visitor (id,nama, total_visitor, keperluan, orang_dituju,  instansi, jam_datang, kartu_visitor, id_divisi, alamat,kendaraan,keterangan) 
    VALUES(NULL,'$nama_visitor', '$total_visitor', '$keperluan', '$orang_dituju','$instansi', '$jam_datang' , '$kartu_visitor' ,'$divisi','$alamat', '$kendaraan','$ket')";
    if (mysqli_query($conn, $sqlpkl)) {
        echo "<script>$('#success-alerts').removeClass('hidden');</script>";
    } else {
        echo "<script>$('#danger-alerts').removeClass('hidden');</script>";
    }
    foreach ($input as $output) {
        $sqlpklh = "INSERT INTO visitor_history (id,nama, total_visitor, keperluan, orang_dituju,  instansi, jam_datang, kartu_visitor, id_divisi, alamat) 
  VALUES(NULL,'$output', '$total_visitor', '$keperluan', '$orang_dituju','$instansi', '$jam_datang' , '$kartu_visitor' ,'$divisi','$alamat')";

        if (mysqli_query($conn, $sqlpklh)) {
            echo "<script>$('#success-alerts').removeClass('hidden');</script>";
        } else {
            echo "<script>$('#danger-alerts').removeClass('hidden');</script>";
        }
    }
}

?>

</html>