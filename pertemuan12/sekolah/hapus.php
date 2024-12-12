<?php
include 'koneksi.php';

$id= $_GET['id'];

mysqli_query($conn,"DELETE from siswa where id='$id'");
header("location:index.php");