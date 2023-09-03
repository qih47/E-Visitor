<?php
// Koneksi ke databas
// Memeriksa apakah token sesi ada
if (isset($_COOKIE['session_token'])) {
    $token = $_COOKIE['session_token'];
// echo $token;
    // Mencari user berdasarkan token sesi
    $user = $database->getSessionToken($token);
// echo $user['session_token'];
    if ($user) {

    } else {
        // Token sesi tidak valid, redirect ke halaman login
        header("location:apps/error_pages/error-404?session=not_found");
        exit;
    }
} else {
    // Token sesi tidak ada, redirect ke halaman login
    header("location:apps/error_pages/error-404?session=not_found");
    exit;
}

if ($_SESSION['npp'] == "" or $_SESSION['token'] == "" or $_SESSION['nama'] == "") {

    header("location:apps/error_pages/error-404?session=not_found");
}
if (strpos($_SERVER['REMOTE_ADDR'], "89.95") === 0) {
    die();
}
