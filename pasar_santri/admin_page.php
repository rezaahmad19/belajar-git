<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

echo "Selamat datang, " . $_SESSION['username'] . "! Ini adalah halaman khusus admin.";
?>

<a href="logout.php">Logout</a>
<a href="add_outlet.php">Tambah Outlet</a>
