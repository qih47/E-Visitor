<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
if (!empty($_GET["id_divisi"])) {
    $id_div = $_GET["id_divisi"];
    $id_dir = "";
} elseif (!empty($_GET["id_direktur"])) {
    $id_dir = $_GET["id_direktur"];
    $id_div = "";
} else {
    echo "Tidak ada kartu";
}
$kartuData = $database->getKartu($id_div,$id_dir);

$data = ""; // Inisialisasi variabel data

foreach ($kartuData as $kartu) {
    $data .= trim($kartu['no_kartu']) . " "; // Menggabungkan no_kartu dengan spasi
}

if (!empty($data)) {
    echo json_encode(array("data" => trim($data))); // Mengembalikan dalam format JSON
} else {
    echo json_encode(array("message" => "Tidak ada data kartu yang ditemukan."));
}

