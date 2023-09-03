<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
session_start();
if (isset($_POST['sesi'])) {
    $id = $_POST['id'];
    $sesi = $_POST['sesi'];
    if ($sesi == "register") {
        $deleteRegistrasi = $database->deleteDataRegistrasi($id);
        if ($deleteRegistrasi) {
            echo "sukses";
        } else {
            echo "gagal";
        }
    } else if ($sesi == "user") {
        $deleteUser = $database->deleteUserData($id);
        if ($deleteUser) {
            header("location:../../pages/controllers/index/hal?i=pages7&pesan=dihapus");
        } else {
            header("location:../../pages/controllers/index/hal?i=pages7&pesan=gagalhapus");
        }
    }
}
