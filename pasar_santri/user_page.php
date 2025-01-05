<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

echo "Selamat datang, " . $_SESSION['username'] . "! Ini adalah halaman khusus user.";
?>

<a href="logout.php">Logout</a>
