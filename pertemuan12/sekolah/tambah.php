<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>SI Sekolah | Data Siswa</h2>
    <br>
    <a href="index.php">Halaman Utama</a>
    <br>
    <br>
    <h3>Tambah Data Siswa</h3>
    <form method= "post" action="tambah_aksi.php">
    <form action="tambah_aksi.php" method="post">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td><input type="number" name="nim"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="SIMPAN"></td>
        </tr>
    </table>
    </form>
</body>
</html>