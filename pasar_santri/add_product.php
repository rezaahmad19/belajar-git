<?php
include 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $target = "images/".basename($image);

    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Produk berhasil ditambahkan!";
        } else {
            echo "Gagal mengunggah gambar!";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="post" action="add_product.php" enctype="multipart/form-data">
    Nama: <input type="text" name="name" required><br>
    Deskripsi: <textarea name="description" required></textarea><br>
    Harga: <input type="text" name="price" required><br>
    Gambar: <input type="file" name="image" required><br>
    <input type="submit" value="Tambah Produk">
</form>
