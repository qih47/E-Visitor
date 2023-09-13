<section class="content">
    <div class="container-fluid">
        <?php
        // require_once $_SERVER['DOCUMENT_ROOT'] . '/visitor/system/viewres/chart/monitoring.php';
        ?>
    </div>
    <div class="card">
        <div class="row ml-3">
            <div class="btn-group">
                <span class="btn btn-primary pull-right button mt-4 mb-3" id="tambah-tamu"><i class="fas fa-user-plus pr-2"></i>Tambah Kunjungan</span>
                <span class="btn btn-primary pull-right button mt-4 ml-2 mb-3" id="downloadlaporanbtn"><i class="fas fa-file-excel pr-2"></i>Laporan Kunjungan</span>
            </div>
        </div>

        <div class="row mt-4 mb-3 hidden" id="form_bulan_download">
            <?php $month = date('Y-m'); ?>
            <div class="col-2 ml-2">
                <input type="month" id="monthdownload" name="month" class="form-control" value="<?= $month; ?>">
            </div>
            <div class="col-2">
                <span class="btn btn-primary button mt-2 " id="downloadlaporan"><i class="fas fa-file-download pr-2"></i>Download Laporan</span>
                <span onclick="location.href='laporan_perhari.php'" class="btn btn-primary button mt-2 " id="laporanperhari"><i class="fas fa-file-download pr-2"></i>Laporan Hari Ini</span>
            </div>
        </div>
        </nav>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/visitor/system/viewres/alerts.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/visitor/system/controllers/getDateSurat.php';
        ?>

        <!-- form start -->

        <form action="../config/processing/input-tamu.php" method="post" id="visitor-form" class="hidden">
            <div class="card-body">
                <span id="test"></span>
                <label for="dasarIzin"><u>DASAR IZIN MASUK</u></label>
                <div class="row">
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Dasar Izin Masuk</span>
                            </div>
                            <select style="border-color: green;" name="dasar" id="dasar" class="form-control" placeholder="Pilih Dasar">
                                <option value="Tidak Ada">Pilih Dasar</option>
                                <option value="Lisan">Lisan / Konfirmasi Penerima</option>
                                <option value="Surat Izin Masuk">Surat Izin Masuk</option>
                            </select>
                        </div>
                    </div>
                </div><br>
                <div class="row" id="dasarIzin">
                    <div class="col-6 hidden" id="suratIzin">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Dasar
                                    Surat</span>
                            </div>
                            <input type="text" name="jenisSurat" id="jenisSurat" style="border-color: green;" class="form-control" placeholder="ND">
                            <span style="font-weight:bold;" class="input-group-text">/</span>
                            <input type="text" name="nosurat" id="nosurat" style="border-color: green;" class="form-control" placeholder="01" required oninvalid="this.setCustomValidity('Nomor Surat Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                            <span style="font-weight:bold;" class="input-group-text">/</span>
                            <input type="text" name="divisiSurat" id="divisiSurat" style="border-color: green;" class="form-control" placeholder="PA">
                            <span style="font-weight:bold;" class="input-group-text">/</span>
                            <select style="border-color: green;" name="blnrom" id="blnrom" class="form-control" placeholder="blnrom">
                                <option value="">PILIH</option>
                                <option value="I">I (JANUARI)</option>
                                <option value="II">II (FEBRUARI)</option>
                                <option value="III">III (MARET)</option>
                                <option value="IV">IV (APRIL)</option>
                                <option value="V">V (MEI)</option>
                                <option value="VI">VI (JUNI)</option>
                                <option value="VII">VII (JULI)</option>
                                <option value="VIII">VIII (AGUSTUS)</option>
                                <option value="IX">IX (SEPTEMBER)</option>
                                <option value="X">X (OKTOBER)</option>
                                <option value="XI">XI (NOVEMBER)</option>
                                <option value="XII">XII (DESEMBER)</option>
                            </select>
                            <span style="font-weight:bold;" class="input-group-text">/</span>
                            <input type="text" name="tglthn" id="tglthn" data-clipboard-text="1" class="form-control" value="<?= date("Y") ?>" readonly>
                        </div>
                    </div>

                    <div class="col-3 hidden" id="tglSurat">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Tanggal Surat</span>
                            </div>
                            <input type="date" name="tanggalSurat" id="tanggalSurat" style="border-color: green;" class="form-control" required oninvalid="this.setCustomValidity('Jenis Surat Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3 hidden" id="konfirm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Konfirm Dari?</span>
                            </div>
                            <input type="text" name="konfirmLisan" id="konfirmLisan" style="border-color: green;" class="form-control" required oninvalid="this.setCustomValidity('Konfirm Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Awal Kunjungan</span>
                            </div>
                            <input type="date" name="awalKunjungan" id="awalKunjungan" style="border-color: green;" class="form-control" required oninvalid="this.setCustomValidity('Awal Kunjungan Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3" id="akhirKunjunganFrm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Akhir Kunjungan</span>
                            </div>
                            <input type="date" name="akhirKunjungan" id="akhirKunjungan" style="border-color: green;" class="form-control" required oninvalid="this.setCustomValidity('Akhir Kunjungan Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3" id="instansiFrm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Instansi</span>
                            </div>
                            <input type="text" name="instansi" id="instansi" style="border-color: green;" class="form-control" placeholder="Masukan Instansi" required oninvalid="this.setCustomValidity('Instansi Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3" id="divisiTujuan">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Divisi
                                </span>
                            </div>
                            <select style="border-color: green;" name="divisi" id="divisi" class="form-control" placeholder="Pilih Divisi">
                                <option> Pilih Divisi Tujuan</option>
                                <?php
                                $getDivisi = $database->getDivisi();
                                if (!empty($getDivisi)) {
                                    foreach ($getDivisi as $row) {
                                ?>
                                        <option value="<?= $row["id"] ?>">
                                            <?= $row["kode_divisi"] ?> (
                                            <?= $row["nama_divisi"] ?> )
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div><br>
                <label for="dataPengunjung"><u><b>JENIS TAMU</b></u></label>
                <div class="row" id="jenisTamu">
                    <div class="col-3">
                        <span class="btn btn-primary" id="tmumum"><i class="fa fa-user pr-2"></i>UMUM</span>
                        <span class="btn btn-primary" id="tmdireksi"><i class="fa fa-user-tie pr-2"></i>DIREKTUR</span>
                        <span class="btn btn-primary" id="tmprakerin"><i class="fa fa-user-graduate pr-2"></i>PRAKERIN</span>
                    </div>
                    <div class="col-3 hidden" id="penerimaFrm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Penerima</span>
                            </div>
                            <input type="text" name="penerima" id="penerima" style="border-color: green;" class="form-control" placeholder="Masukan Nama Penerima" required oninvalid="this.setCustomValidity('Penerima Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3 hidden" id="prakerinFrm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Pembimbing</span>
                            </div>
                            <input type="text" name="pembimbing" id="pembimbing" style="border-color: green;" class="form-control" placeholder="Masukan Nama Pembimbing" required oninvalid="this.setCustomValidity('Penerima Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col-3 hidden" id="direkturFrm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Direktur
                                </span>
                            </div>
                            <select style="border-color: green;" name="direktur" id="direktur" class="form-control" placeholder="Pilih Direktur">
                                <option value=""> Pilih Direktur</option>
                                <?php
                                $getDirektur = $database->getDirektur();
                                if (!empty($getDirektur)) {
                                    foreach ($getDirektur as $row) {
                                ?>
                                        <option value="<?= $row["id"] ?>">
                                            <?= $row["nama_dir"] ?> (
                                            <?= $row["jabatan"] ?> )
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3 hidden" id="jenisTamuFrm">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Jenis Tamu</span>
                            </div>
                            <input type="text" name="jenisTM" id="jenisTM" style="border-color: green;" class="form-control" readonly>
                        </div>
                    </div>
                </div><br>
                <div class="col-sm-12 d-flex justify-content-end card-footer">
                    <button type="submit" id="reg" name="reg" value="Registrasi" style="border-color: green;" class="btn btn-primary me-1 mb-1 mr-2">Registrasi<i class="fas fa-user-plus ml-3"></i></button>
                    <button type="button" id="reservasi" name="reservasi" value="Reservasi" style="border-color: green;" class="btn btn-primary me-1 mb-1" onclick="PreRegister()">Jadikan Reservasi<i class="fas fa-user-check ml-3"></i></button>
                </div>
                <div class="row mt-3" id="registrasiFrm">
                    <div class="col-12">
                        <label for="dataPengunjung"><u>DATA PENGUNJUNG</u></label>
                        <div class="row" id="dataPengunjung">
                            <div class="col-3">
                                <div class="form-group">
                                    <div class="input-group control-group ">
                                        <span style="font-weight:bold;" class="input-group-text">Nama</span>
                                        <input type="text" name="addmore[]" style="border-color: green;" class="form-control" placeholder="Masukan Nama Pengunjung" required>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more-visitor" type="button"><i class="glyphicon glyphicon-plus fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="after-add-more">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Alamat</span>
                                    </div>
                                    <input type="text" name="alamat" id="alamat" style="border-color: green;" class="form-control" placeholder="Masukan Alamat Pengunjung" required oninvalid="this.setCustomValidity('Alamat Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Keperluan</span>
                                    </div>
                                    <select style="border-color: green;" name="keperluan" id="keperluan" class="form-control" placeholder="Pilih Keperluan">
                                        <option value="Tidak Ada"> Pilih Keperluan</option>
                                        <option value="Dinas">Dinas</option>
                                        <option value="Meeting">Meting</option>
                                        <option value="Aanwizing">Aanwizing</option>
                                        <option value="Kirim Barang">Kirim Barang</option>
                                        <option value="Kirim Dokumen">Kirim Dokumen</option>
                                        <option value="Order">Order</option>
                                        <option value="Cek Stock">Cek Stock</option>
                                        <option value="Cek Kotak Amal">Cek Kotak Amal</option>
                                        <option value="Register">Register</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group" id="kendaraan">
                                    <div class="input-group control-group ">
                                        <div class="input-group-prepend">
                                            <span style="font-weight:bold;" class="input-group-text">Kendaraan</span>
                                        </div>
                                        <input type="text" name="kendaraan" style="border-color: green;" class="form-control" placeholder="Nama & Plat Nomor Kendaraan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group" id="nohpfrm">
                                    <div class="input-group control-group ">
                                        <div class="input-group-prepend">
                                            <span style="font-weight:bold;" class="input-group-text">No HP</span>
                                        </div>
                                        <input type="text" name="nohp" style="border-color: green;" class="form-control" placeholder="Masukan No HP">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Kartu Akses
                                        </span>
                                    </div>
                                    <select style="border-color: green;" name="kartu" id="kartu" class="form-control" placeholder="Pilih Divisi">
                                        <option> Pilih Kartu</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Kunci Locker</span>
                                    </div>
                                    <select style="border-color: green;" name="kartu" id="kartu" class="form-control" placeholder="Pilih Divisi">
                                        <option value="kosong"> Pilih Kunci</option>
                                        <?php
                                        for ($i = 1; $i <= 40; $i++) {
                                            echo "<option value='Key-$i'>Key-$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div><br>

                        <div class="col-sm-12 d-flex justify-content-end card-footer">
                            <button type="submit" id="simpan" name="simpan" value="simpan" style="border-color: green;" class="btn btn-primary me-1 mb-1 mr-2">Simpan<i class="fas fa-user-plus ml-3"></i></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tableVisitor" class="table table-dark table-striped table-hover wb-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Nama Tamu</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Instansi</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Jam Masuk</th>
                            <th scope="col">Jam Keluar</th>
                            <th scope="col">No. HP</th>
                            <th scope="col">Jenis Tamu</th>
                            <th scope="col">Verifikasi</th>
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
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Informasi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal-body">

            </div>
            <div class="modal-footer" id="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="prosesFrmModal" data-backdrop="static">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Proses Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="modal-body-proses">

            </div>
            <div class="modal-footer" id="modal-footer-proses">
                <button type="button" id="close" name="close" style="border-color: green;" class="btn btn-danger me-1 mb-1 mr-2" data-dismiss="modal">Close<i class="fas fa-door-open ml-3"></i></button>
                <button type="button" id="simpan" name="simpan" value="simpan" style="border-color: green;" class="btn btn-primary me-1 mb-1 mr-2" onclick="simpanFromProsesModal()">Registrasi<i class="fas fa-book ml-3"></i></button>

            </div>
        </div>
    </div>
</div>