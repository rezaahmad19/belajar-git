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
    $stmt = $conn->prepare("SELECT * FROM outlets WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $outlet = $result->fetch_assoc();

    if (!$outlet) {
        die("Outlet tidak ditemukan.");
    }
} else {
    die("ID tidak diberikan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE outlets SET name = ?, location = ?, description = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $location, $description, $id);

    if ($stmt->execute()) {
        header("Location: admin_outlets.php?message=Outlet berhasil diupdate.");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Outlet</title>
    <style>
        /* Gaya Umum */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f9fc;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Kontainer Utama */
.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

/* Heading */
h1 {
    text-align: center;
    font-size: 24px;
    color: #1d3557;
    margin-bottom: 20px;
}

/* Form */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Label */
label {
    font-size: 16px;
    color: #1d3557;
    font-weight: bold;
}

/* Input dan Textarea */
input[type="text"], textarea {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    transition: border-color 0.3s ease;
}

/* Hover Effect pada Input */
input[type="text"]:hover, textarea:hover {
    border-color: #1d3557;
}

/* Fokus pada Input */
input[type="text"]:focus, textarea:focus {
    border-color: #457b9d;
    box-shadow: 0 0 8px rgba(69, 123, 157, 0.3);
}

/* Tombol */
button[type="submit"], .btn-secondary {
    background-color: #1d3557;
    color: #ffffff;
    padding: 12px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
}

/* Hover Effect pada Tombol */
button[type="submit"]:hover, .btn-secondary:hover {
    background-color: #457b9d;
}

/* Link Kembali */
a {
    text-align: center;
    display: block;
    margin-top: 20px;
    color: #1d3557;
    font-size: 16px;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Outlet</h1>
        <form method="POST">
            <label for="name">Nama Outlet:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($outlet['name']); ?>" required>

            <label for="location">Lokasi:</label>
            <input type="text" id="location" name="location" value="<?= htmlspecialchars($outlet['location']); ?>" required>

            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($outlet['description']); ?></textarea>

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
        <a href="admin_outlets.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
