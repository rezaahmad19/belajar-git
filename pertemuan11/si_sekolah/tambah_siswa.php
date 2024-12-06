<?php
//koneksi ke DBMS
$conn = mysqli_connect("localhost", "root", "", "sekolahann");
//Cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) { //post akan mengarahkan ke key submit
    //Ambil data dari tiap element di form
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $agama = $_POST["agama"];
    $asal = $_POST["asal"];
    //query insert data, lebih baik dideskripsikan nama tabel
    $query = "INSERT INTO data_siswa (nama_siswa, alamat_siswa, agama, asal_sekolah)
    VALUE ('$nama', '$alamat', '$agama', '$asal')";
    mysqli_query($conn, $query);
    //cek apakah data berhasil ditambahkan
    if (mysqli_affected_rows($conn) > 0) {
        echo "berhasil!";
    } else {
        echo "gagal!<br>";
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
</head>
<body>
    <h1>Tambah Data Siswa</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="alamat">Alamat : </label>
                <input type="text" name="alamat" id="alamat">
            </li>
            <li>
                <label for="agama">Agama : </label>
                <input type="text" name="agama" id="agama">
            </li>
            <li>
                <label for="asal">Asal Sekolah : </label>
                <input type="text" name="asal" id="asal">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>