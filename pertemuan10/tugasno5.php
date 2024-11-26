<?php

$nilai = [80, 90, 75, 85, 100];
$total = 0;

// Menghitung jumlah nilai menggunakan perulangan
foreach ($nilai as $value) {
  $total += $value;
}

// Menghitung rata-rata nilai
$rata_rata = $total / count($nilai);

// Menampilkan output
echo "Jumlah total nilai: $total\n";
echo "Rata-rata nilai: $rata_rata";
?>