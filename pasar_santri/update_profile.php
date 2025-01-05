<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $order_options = $_POST['order_options'];
    $admin_id = $_SESSION['admin_id']; // Ambil admin_id dari sesi

    // Simpan data ke database (misalnya, ke tabel 'profile')
    $sql = "UPDATE profile SET description='$description', contact='$contact', address='$address', order_options='$order_options' WHERE admin_id='$admin_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Profil berhasil diperbarui!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<a href="admin_home.php">Kembali ke Beranda Admin</a>
