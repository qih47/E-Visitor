                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "selesai") {
                        echo "<div class='alert alert-success alert-dismissible ' id='success-alerts'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h5><i class='icon fas fa-check'></i> KUNJUNGAN SELESAI!</h5>
    Pengunjung Telah Selesai Berkunjung!
</div>";
                    }

                    if ($_GET['pesan'] == "berhasil") {
                        echo "<div class='alert alert-success alert-dismissible ' id='success-alerts'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fas fa-check'></i> DATA KUNJUNGAN BERHASIL DITAMBAHKAN!</h5>
        Pengunjung Telah Selesai Berkunjung!
    </div>";
                    }
                    if ($_GET['pesan'] == "gagal") {
                        echo "<div class='alert alert-danger alert-dismissible ' id='danger-alerts'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <h5><i class='icon fas fa-check'></i> DATA KUNJUNGAN GAGAL DITAMBAHKAN!</h5>
        Kesalahan dalam inputan data kunjungan!
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