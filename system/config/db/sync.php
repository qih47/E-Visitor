<?php
// Koneksi ke database
$dsn = 'mysql:host=localhost;dbname=visitor';
$username = 'root';
$password = 'mysql';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('Database connection failed: ' . $e->getMessage());
}

return $pdo;

// echo "My id is $id and my name is $name";