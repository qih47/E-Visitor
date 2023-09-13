<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';

$index = $_GET['i'];
$id = preg_replace('/[^0-9]/', '', $index);
$message = $_GET['pesan'];
if (!$_GET['pesan']) {
    $pesan = "";
} else {
    $pesan = "&pesan=$message";
}
// $hal = $database->getHalaman($id);
$row = $database->getHalPath($id);
$halaman = $row['hal'];
$path = $row['path'];

$idHal = $row['id'];
// echo $idHal;
// die();
if (isset($idHal) == $id) {
    if ($id == 1) {
        $updateStatusPage = $database->updatePageStatus($id, $status);
        header("location:../../../?hal=$halaman$pesan");
    } else if ($id == 5) {
        $updateStatusPage = $database->updatePageStatus($id, $status);
        header("location:../../../?hal=cetak&kunjungan=$message");
        $_SESSION['idHal'] = $idHal;
    } else {
        $updateStatusPage = $database->updatePageStatus($id, $status);
        header("location:../../../main.php?hal=$halaman$pesan");
        $_SESSION['idHal'] = $idHal;
    }
}
