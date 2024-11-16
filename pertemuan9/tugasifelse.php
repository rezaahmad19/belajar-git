<?php
$jarak = 88;
if ($jarak > 100) {
    $hasil = "Jauh";
} else if ($jarak > 50){
    $hasil = "Sedang";
} else if ($jarak > 10){
    $hasil = "Dekat";
} else if($jarak > 5){
    $hasil = "Tidak Berjalan";
}
echo "Jarak Anda: $jarak<br>";
echo "Hasil: $hasil";
?>