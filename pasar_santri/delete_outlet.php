<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM outlets WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_outlets.php?message=Outlet berhasil dihapus.");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
} else {
    die("ID tidak diberikan.");
}
?>
