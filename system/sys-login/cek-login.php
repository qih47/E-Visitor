<?php
$pdo = require_once '../config/db/sync.php';
require_once "../sys-login/getInfo.php";
require_once "../config/db/maok.php";

$database = new Database($pdo);

// Mendapatkan data dari form
$nppOrUsername = $_POST['npp'];
$password = $_POST['password'];

// echo $password;
// die();
// Cek apakah login menggunakan NPP atau username
$user = $database->getUserByNppOrUsername($nppOrUsername);
$npp = $user['npp'];
$nama = $user['nama'];
$role = $user['role'];
if ($user) {
	// Verifikasi password
	if (password_verify($password, $user['password'])) {
		// Generate token sesi
		$token = generateToken();
		date_default_timezone_set('Asia/Jakarta');
		$expiry = date('Y-m-d H:i:s');
		// Simpan token sesi di database
		if ($database->insertSessionLogin($npp, $token, $expiry) && $database->insertHistoryLogin($token, $expiry, $npp, $nama, $role, $browserName, $browserVersion, $deviceType)) {
			echo 'Penyisipan berhasil';

			// Set token sesi sebagai cookie
			setcookie('session_token', $token, time() + 3600, '/'); // Cookie berlaku selama 1 jam

			session_start();
			$_SESSION['idUser'] = $user['id'];
			$_SESSION['nama'] = $user['nama'];
			$_SESSION['profile'] = $user['profile'];
			$_SESSION['role'] = $user['role'];
			$_SESSION['npp'] = $user['npp'];
			$_SESSION['lokasi'] = $user['lokasi'];
			$_SESSION['token'] = $token;
			$_SESSION['level'] = $user['level'];
			$_SESSION['pesan'] = "loginback";
			// alihkan ke halaman dashboard admin
			header("location:../../login?hal=main");
		} else {
			header("location:../../login?hal=main&pesan=gagal");
			exit;
		}
	} else {
		header("location:../../login?hal=main&pesan=salah");
		exit;
	}
} else {
	header("location:../../login?hal=main&pesan=nouser");
	exit;
}

function generateToken()
{
	return bin2hex(random_bytes(32)); // Menghasilkan token sesi acak
}
