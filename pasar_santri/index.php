<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] == 'admin') {
    header("Location: admin_home.php");
} else {
    header("Location: user_home.php");
}
?>



<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] == 'admin') {
    echo "<a href='add_outlet.php'>Tambah Outlet</a><br>";
}

$sql = "SELECT * FROM outlets";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Nama: " . $row["name"]. " - Lokasi: " . $row["location"]. " - Deskripsi: " . $row["description"]. "<br>";
        if ($_SESSION['role'] == 'admin') {
            echo "<a href='edit_outlet.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_outlet.php?id=" . $row["id"] . "'>Hapus</a><br>";
        }
    }
} else {
    echo "0 hasil";
}
?>
