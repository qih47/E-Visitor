<html>
<title>Cetak Bukti Kunjungan</title>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>
<style>
    td {
        font-size: 12px;
        line-height: 35px;
    }

    .garis_tepi1 {
        border: 4px solid black;
    }

    .garis_tepi2 {
        border: 3px solid black;
        height: 571px;
    }

    .par {
        font-size: 10px;

    }

    .par1 {
        font-size: 14px;

    }
</style>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/controllers/getDateInd.php';
date_default_timezone_set('Asia/Jakarta');
?>

<body>
    <div class="col-lg-4 ">
        <?php
        if (isset($_GET['kunjungan'])) {
            $id    = $_GET['kunjungan'];
        } else {
            die("Error. No ID Selected!");
        }
        $data = $database->getDataRegistrasi($id);
        $tanggal = date('d');
        $month = date('M');
        $bulan = getMonthIndonesia($month);
        $tahun = date('Y');

        if ($data['jenisTamu'] == "UMUM" || $data['jenisTamu'] == "PRAKERIN") {
            $penerima = $data['penerima'];
            $tujuan = $data['nama_divisi'];
        } else {
            $penerima = $data['nama_dir'];
            $tujuan = $data['jabatan'];
        }
        $dateTime = $data['jam_masuk'];
        $timeOnly = date("H:i:s", strtotime($dateTime));
        ?>
        <div style="width: 480px; height: 640px; border: 3px solid black">
            <div class="garis_tepi1">
                <img src="assets/img/logo_pindad.png " alt="PAM" align="left" class="ml-2 mt-3" width="50px" height="35px">
                <img src="assets/img/iso.png " alt="PAM" align="right" class="mr-2 mt-3" width="50px" height="35px">
                <p align="center" class="mr-3 mt-2 par1" width="70px" height="50px"><b>P T . P I N D A D
                        <br>D I V I S I &nbsp P E N G A M A N A N</b></p>
            </div>
            <div class="garis_tepi2">
                <center>
                    <p class="par1 mt-3"><b><u>BUKTI KUNJUNGAN TAMU</b></u>
                    <p>
                </center>
                <span style="padding-left: 57%;">Bandung, <?php echo $tanggal . " " . $bulan . " " . $tahun; ?></span>
                <table style="margin: 20px; " class="mt-2">
                    <tr>
                        <td><b>Nomor Kartu</b></td>
                        <td>&nbsp:&nbsp </td>
                        <td><?= $data['no_kartu'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Total Visitor</b></td>
                        <td>&nbsp:&nbsp </td>
                        <td><?= $data['totalVisitor'] ?> ORANG</td>
                    </tr>
                    <tr>
                        <td><b>Instansi</b></td>
                        <td>&nbsp:&nbsp </td>
                        <td><?= $data['instansi'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Alamat</b></td>
                        <td>&nbsp:&nbsp</td>
                        <td><?= $data['alamat'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Tujuan</b> </td>
                        <td>&nbsp:&nbsp</td>
                        <td><?= $penerima ?> (<?= strtoupper($tujuan) ?>)</td>
                    </tr>
                    <tr>
                        <td><b>Keperluan</b></td>
                        <td>&nbsp:&nbsp</td>
                        <td><?= $data['keperluan'] ?></td>
                    </tr>
                    <tr>
                        <td><b>Kendaraan</b></td>
                        <td>&nbsp:&nbsp</td>
                        <td><?= $data['kendaraan']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Jam Masuk</b></td>
                        <td>&nbsp:&nbsp</td>
                        <td><?= $timeOnly; ?> WIB
                        </td>
                    </tr>
                </table>
                <p align="left" class="ml-3 par"><b>&nbsp&nbspList Tamu: </b><?= $data['nama'] ?></p>
                <p class="par ml-4 mr-5"><b>*Dengan ini bersedia menaati semua peraturan dan tata tertib bagi tamu yang
                        ada di PT PINDAD</b></p><br><br>
                <p align="center"><b>PENERIMA</b> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b>TAMU</b> </p>
                <br>
                <p align="center">&nbsp &nbsp &nbsp &nbsp <b>..........................</b> &nbsp &nbsp &nbsp &nbsp
                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                    &nbsp <b>....................</b> </p>
                <?php
                $ran = $data['kendaraan'];
                $text = "No. Ran :";
                if ($data['kendaraan'] == NULL) {
                    $kendaraan = "";
                } else {
                    $kendaraan = "$text $ran";
                }
                ?>
            </div>
            <br>
            <p align="center"><b>Setiap Tamu Wajib Mengembalikan Bukti Kunjungan Tamu Ini Ke Petugas di Resepsionis
                    Setelah Selesai Berkunjung
                </b></p>
        </div>
    </div>
    </div>


</body>

</html>
<script>
    var css = '@page { size: landscape; }',
        head = document.head || document.getElementsByTagName('head')[0],
        style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet) {
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);

    window.onafterprint = window.close;
    window.print();
</script>