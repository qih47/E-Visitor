<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/controllers/getDateRomawi.php';

$bulan = date('n');
$romawi = getRomawi($bulan);
$tahun = date ('Y');
$nomor = $romawi."/".$tahun;
