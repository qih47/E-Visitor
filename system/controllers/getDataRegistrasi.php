<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
$id = $_POST['id'];
$data = $database->getDataRegistrasi($id);
echo json_encode($data);
?>