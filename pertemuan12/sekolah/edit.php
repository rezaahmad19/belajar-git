<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>SI Sekolah | Edit Data Siswa</h2>
    <br>
    <a href="index.php">Kembali</a>
    <h3>Edit Data Siswa</h3>

    <?php
    include 'koneksi.php';
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM siswa WHERE id='$id'");
    while ($data = mysqli_fetch_array($query)) {
    ?>
    <form action="edit_aksi.php" method="post">
        <table>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" >
                </td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>
                    <input type="number" name="nim" value="<?php echo $data['nim']; ?>" >
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" >
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    </form>
    <?php
    }
    ?>
    
</body>
</html>