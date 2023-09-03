<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
$session_value = (isset($_SESSION['token'])) ? $_SESSION['token'] : '';
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/policy/secure-pages.php';
$id = $_SESSION['idHal'];
// echo $id;
$row = $database->getHalPath($id);

require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/' . $row['path'] . '.php';