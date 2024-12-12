<?php
$conn = mysqli_connect("localhost","root","","sekolah");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : ".mysqli_connect_error();
}