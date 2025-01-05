<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="stylesheet" href="style.css">
    <style>
       body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f8ff; /* Latar belakang biru sangat terang */
    color: #333;
}

header {
    background-color: #1e3a8a; /* Biru gelap */
    color: #ffffff; /* Teks putih */
    padding: 15px 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header h1 {
    margin: 0;
    font-size: 2em;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 10px 0;
    text-align: center;
}

nav ul li {
    display: inline-block;
    margin: 0 15px;
}

nav ul li a {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 15px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

nav ul li a:hover {
    background-color: #2563eb; /* Biru terang */
}

main {
    padding: 20px;
    background-color: #ffffff; /* Latar belakang putih */
    margin: 20px auto;
    width: 80%;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

footer {
    background-color: #1e3a8a;
    color: #ffffff;
    text-align: center;
    padding: 15px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
    font-size: 0.9em;
    box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
}

.about-content {
    line-height: 1.8;
    font-size: 1.1em;
    color: #555;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: white;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #1e3a8a;
    color: white;
}

tr:nth-child(even) {
    background-color: #f4f4f4;
}

tr:hover {
    background-color: #eaf4ff;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #1e3a8a;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    transition: background-color 0.3s;
    font-size: 0.9em;
}

.btn:hover {
    background-color: #2563eb;
}

    </style>
</head>
<body>
    <header>
        <h1>Pasar Santri</h1>
        <nav>
            <ul>
                <li><a href="user_home.php">Beranda</a></li>
                <li><a href="user_profile.php">Profil</a></li>
                <li><a href="outlets.php">Outlet</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Tentang Kami</h2>
        <p class="about-content">
            Pasar Santri adalah sebuah platform digital yang bertujuan untuk menghubungkan para santri dengan berbagai produk dan layanan yang bermanfaat bagi kehidupan mereka. Kami menyediakan berbagai outlet yang menawarkan produk berkualitas mulai dari buku, alat tulis, hingga kebutuhan harian lainnya.
        </p>
        <p class="about-content">
            Visi kami adalah memberdayakan santri di seluruh Indonesia dengan memudahkan mereka untuk mengakses berbagai produk yang mereka butuhkan, sekaligus mendukung perkembangan ekonomi umat melalui sistem yang efisien dan aman.
        </p>
        <h3>Tujuan Kami</h3>
        <ul>
            <li>Memberikan akses mudah kepada santri untuk membeli produk-produk berkualitas.</li>
            <li>Mendukung kegiatan ekonomi umat melalui transaksi yang aman dan mudah.</li>
            <li>Menjadi pusat informasi dan solusi bagi kebutuhan para santri.</li>
        </ul>
    </main>

    <footer>
        <p>&copy; 2025 Pasar Santri. Semua hak cipta dilindungi.</p>
    </footer>
</body>
</html>
