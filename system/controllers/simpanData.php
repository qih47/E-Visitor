<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
session_start();
if (isset($_GET['sesi'])) {
    $sesi = $_GET['sesi'];
    $dasar =  $_POST['dasar'];
    if ($dasar == "Lisan") {
        $dasarIzin =  $_POST['konfirm'];
        $tglIzin =  date("Y-m-d");
    } else {
        $dasarIzin =  $_POST['dasarSurat'];
        $tglIzin =  $_POST['tglSurat'];
    }
    $instansi =  $_POST['instansi'];

    $jenisTamu = $_POST['jenisTamu'];
    if ($jenisTamu == "DIREKSI") {
        $penerima = "";
        $direktur = $_POST['penerima'];
        $divisi = "";
    } else {
        $penerima = $_POST['penerima'];
        $divisi = $_POST['divisi'];
        $direktur = "";
    }
    $status = "Menunggu";
    $verifikasi = "Not Verified";
    $user = $_SESSION['idUser'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $selisihDetik = strtotime($akhir) - strtotime($awal);
    $masaKunjungan = floor($selisihDetik / (60 * 60 * 24)) + 1;
    $insertPreRegister = $database->insertDataPreRegister($dasar, $dasarIzin, $tglIzin, $awal, $akhir, $masaKunjungan, $instansi, $penerima, $divisi, $direktur, $jenisTamu, $status, $verifikasi, $user);
    // echo "Jenis:".$dasar, "Dasar:" . $dasarIzin, "Tgl Dasar:" . $tglIzin, "Awal:" . $awal, "Akhir:" . $akhir, "Masa:" . $masaKunjungan, "Instansi:" . $instansi, "Penerima:" . $penerima, "Divisi:" . $divisi, "Direktur:" . $direktur, "Jenis Tamu:" . $jenisTamu, "Status:" . $status, "Verifikasi:" . $verifikasi, "User:" . $user;
    // die();
    if ($insertPreRegister) {
        echo "sukses";
    } else {
        echo "gagal";
    }
}
