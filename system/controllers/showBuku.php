<?php
$table = <<<EOT
 (SELECT 
    registrasi.*,
    divisi.nama_divisi,
    direktur.nama_dir,
    direktur.jabatan,
    kartu.no_rfid,area.id as idArea
FROM registrasi 
LEFT JOIN divisi ON registrasi.id_divisi = divisi.id
LEFT JOIN direktur ON registrasi.id_direktur = direktur.id
LEFT JOIN kartu ON registrasi.id_kartu = kartu.id LEFT JOIN area ON divisi.id_area = area.id OR direktur.id_area = area.id
ORDER BY registrasi.id DESC) AS temp
EOT;

$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'statusKunjungan', 'dt' => 1),
    array('db' => 'nama',     'dt' => 2),
    array('db' => 'totalVisitor',     'dt' => 3),
    array('db' => 'instansi',     'dt' => 4),
    array('db' => 'nama_divisi',     'dt' => 5),
    array('db' => 'jam_masuk',     'dt' => 6),
    array('db' => 'jam_keluar',     'dt' => 7),
    array('db' => 'noHp',     'dt' => 8),
    array('db' => 'jenisTamu',     'dt' => 9),
    array('db' => 'verifikasi',     'dt' => 10),
    array('db' => 'penerima',     'dt' => 11),
    array('db' => 'no_rfid',     'dt' => 12),
    array('db' => 'idArea',     'dt' => 13),
    array('db' => 'nama_dir',     'dt' => 14),
    array('db' => 'jabatan',     'dt' => 15),
);

// SQL server connection information
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/sync.php';
$sql_details = array(
    'pdo' => $pdo,

);


require('ssp.class.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
