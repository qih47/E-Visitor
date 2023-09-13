<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/db/dbconn.php';
if (isset($_GET['hal'])) {
    $session_value = (isset($_SESSION['token'])) ? $_SESSION['token'] : '';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/config/policy/secure-pages.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/system/lib/lib-header.php';
    if ($_GET['hal'] == "login") {
        require_once "system/config/policy/session-token-expired.php";
        include "login.php";
    } else if ($_GET['hal'] == "logout") {
        include "logout.php";
    } else if ($_GET['hal'] == "not_found") {
        include "apps/error_pages/error-404.php";
    } else if ($_GET['hal'] == "cetak") {
        $id = $_SESSION['idHal'];
        $row = $database->getHalPath($id);
        require_once $_SERVER['DOCUMENT_ROOT'] . '/E-Visitor/' . $row['path'] . '.php';
    } else {
        // echo $hal;
        include "app.php";
    }
} else {
    include "login.php";
    // header("location:pages/controllers/index/hal.php?i=pages1&pesan=loginback");
}
