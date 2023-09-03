<?php
$table = <<<EOT
 (SELECT divisi.id as idDivisi,divisi.nama_divisi,divisi.kode_divisi,area.nama_area,area.keterangan FROM divisi JOIN area ON divisi.id_area = area.id ORDER BY divisi.nama_divisi ASC) AS temp
EOT;

$primaryKey = 'idDivisi';

$columns = array(
    array('db' => 'idDivisi', 'dt' => 0),
    array('db' => 'nama_divisi', 'dt' => 1),
    array('db' => 'kode_divisi',     'dt' => 2),
    array('db' => 'nama_area',     'dt' => 3),
    array('db' => 'keterangan',     'dt' => 4),
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
