<?php
// cau_hinh/ket_noi.php

$host = 'localhost';
$db   = 'webnhom7';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Kết nối database thất bại: ' . $e->getMessage());
}

// Bật session dùng chung toàn site
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
