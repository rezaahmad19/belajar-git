<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$alamat = $_POST['alamat'];

mysqli_query($conn,"UPDATE siswa set nama='$nama', nim='$nim', alamat='$alamat' where id ='$id'");
header("location:index.php");
?>