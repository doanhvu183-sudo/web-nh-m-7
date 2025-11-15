<?php
session_start();

$id = $_GET['id'] ?? 0;

unset($_SESSION['gio_hang'][$id]);

header("Location: gio_hang.php");
exit;
