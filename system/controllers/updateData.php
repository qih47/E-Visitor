<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
if (isset($_POST['sesi'])) {
    if ($_POST['sesi'] == "selesai") {
        $status = "Selesai";
        $id = $_POST['id'];
        $updateSelesai = $database->updateStatusKunjungan($id, $status);
        if($updateSelesai){
            echo "sukses";
        }else{
            echo "gagal";
        }
    }
}
