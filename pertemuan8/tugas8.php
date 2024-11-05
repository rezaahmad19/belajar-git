<?php
// Pemasukan
$pemasukan = 50000000;

// Hutang a
$hutang_a = 16500000;
$bunga_hutang_a = 0.05; // 5%

// Hutang b
$hutang_b = 9500000;
$bunga_hutang_b = 0.045; // 4.5%

// Hitung total bunga hutang
$total_bunga_hutang = ($hutang_a * $bunga_hutang_a) + ($hutang_b * $bunga_hutang_b);

// Hitung total hutang
$total_hutang = $hutang_a + $hutang_b;

// Hitung sisa uang
$sisa_uang = $pemasukan - $total_hutang - $total_bunga_hutang;

// Tampilkan hasil
echo "Sisa uang: " . number_format($sisa_uang, 0, ',', '.') . "<br>";
echo "Total bunga hutang: " . number_format($total_bunga_hutang, 0, ',', '.') . "<br>";
echo "Total hutang: " . number_format($total_hutang, 0, ',', '.') . "<br>";
?>