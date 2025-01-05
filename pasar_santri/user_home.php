<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username']; // Mendapatkan username dari session
echo "Selamat datang, " . $username . "!";

// Menampilkan daftar outlet dari database
$outlet_query = "SELECT * FROM outlets LIMIT 5"; // Ambil 5 outlet pertama
$outlet_result = mysqli_query($conn, $outlet_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda User</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Gaya CSS dengan kombinasi warna biru dan putih */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f8ff; /* Warna biru muda */
    margin: 0;
    padding: 0;
}

header {
    background-color: #1e3a8a; /* Biru gelap */
    color: white;
    padding: 15px 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    font-size: 2em;
    letter-spacing: 1px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 10px 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin: 0 20px;
}

nav ul li a {
    color: #cfe2ff; /* Biru terang */
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #fffbeb; /* Putih kekuningan */
}

main {
    padding: 20px;
    background-color: white;
    margin: 20px auto;
    width: 80%;
    border-radius: 10px;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

footer {
    background-color: #1e3a8a; /* Biru gelap */
    color: #f0f8ff; /* Biru muda */
    text-align: center;
    padding: 10px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
    font-size: 0.9em;
}

h2 {
    color: #1e40af; /* Biru medium */
}

.welcome-message {
    font-size: 1.3em;
    margin-bottom: 20px;
    color: #334155; /* Biru abu-abu */
}

.section {
    margin-bottom: 30px;
}

.outlet-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.outlet-item {
    background-color: #cfe2ff; /* Biru terang */
    padding: 15px;
    border-radius: 10px;
    width: 23%;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, background-color 0.3s;
}

.outlet-item:hover {
    transform: scale(1.05);
    background-color: #93c5fd; /* Biru lebih gelap saat hover */
}

.outlet-item h4 {
    margin: 0;
    font-size: 1.2em;
    color: #1e40af; /* Biru medium */
}

.outlet-item p {
    color: #64748b; /* Biru abu-abu */
}

.date-time {
    font-size: 0.9em;
    color: #64748b; /* Biru abu-abu */
    text-align: center;
    margin-top: 10px;
}

.notification {
    background-color: #93c5fd; /* Biru terang */
    color: white;
    padding: 10px;
    margin-bottom: 20px;
    text-align: center;
    border-radius: 5px;
    font-weight: bold;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

    </style>
</head>
<body>
    <header>
        <h1>Pasar Santri</h1>
        <nav>
            <ul>
                <li><a href="user_profile.php">Profil</a></li>
                <li><a href="about_us.php">Tentang Kami</a></li>
                <li><a href="outlets.php">Outlet</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="welcome-message">
            <h2>Selamat datang di Pasar Santri!</h2>
            <p>Halo, <?php echo $username; ?>! Anda telah berhasil login. Nikmati pengalaman berbelanja dan berinteraksi dengan komunitas kami.</p>
        </div>
        
        <!-- Notifikasi untuk pengguna -->
        <div class="notification">
            <p>Pemberitahuan penting: Pastikan untuk memeriksa outlet terbaru di Pasar Santri!</p>
        </div>

        <!-- Informasi tentang Pasar Santri -->
        <div class="section">
            <h3>Apa itu Pasar Santri?</h3>
            <p>Pasar Santri adalah platform yang didedikasikan untuk mempertemukan para santri dengan berbagai produk dan layanan yang relevan. Di sini, Anda bisa menjelajahi berbagai outlet yang menawarkan berbagai barang dan layanan dengan harga yang bersahabat.</p>
        </div>

        <!-- Daftar Outlet -->
        <div class="section">
            <h3>Outlet Terbaru</h3>
            <div class="outlet-list">
                <?php while ($outlet = mysqli_fetch_assoc($outlet_result)) { ?>
                    <div class="outlet-item">
                        <h4><?php echo $outlet['name']; ?></h4>
                        <p><?php echo substr($outlet['description'], 0, 100) . '...'; ?></p>
                        <a href="outlet_details.php?id=<?php echo $outlet['id']; ?>">Lihat Detail</a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Tanggal dan Waktu Sekarang -->
        <div class="date-time">
            <p>Waktu Sekarang: <?php echo date('l, d F Y H:i'); ?></p>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Pasar Santri. Semua hak cipta dilindungi.</p>
    </footer>
</body>
</html>
