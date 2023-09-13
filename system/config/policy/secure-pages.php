<?php
if (isset($_COOKIE['session_token'])) {
    $token = $_COOKIE['session_token'];
    // echo $token;
    $user = $database->getSessionToken($token);
    // echo $user['session_token'];
    if ($user) {
    } else {
        session_destroy();
        header("location:?pesan=sesi_berakhir");
        exit;
    }
} else {
    session_destroy();
    header("location:?pesan=sesi_berakhir");
    exit;
}

if ($_SESSION['npp'] == "" or $_SESSION['token'] == "" or $_SESSION['nama'] == "") {
    session_destroy();
    header("location:?hal=not_found");
}
if (strpos($_SERVER['REMOTE_ADDR'], "89.95") === 0) {
    die();
}
