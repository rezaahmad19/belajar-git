<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

echo "Selamat datang, " . $_SESSION['username'] . "!";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <style>
       /* Reset dan pengaturan dasar */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #eaf4fc; /* Biru muda */
    color: #333; /* Warna teks netral */
}

header {
    background-color: #003366; /* Biru gelap */
    color: white;
    padding: 20px 0;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 2.5em;
    margin: 0;
    letter-spacing: 2px;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 20px 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}

nav ul li {
    display: inline;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

nav ul li a:hover {
    background-color: #4c99ff; /* Biru terang */
    transform: scale(1.1);
}

main {
    max-width: 1200px;
    margin: 30px auto;
    padding: 20px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.container {
    text-align: center;
}

h2 {
    font-size: 2em;
    color: #003366;
    margin-bottom: 20px;
}

.profile-info {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 700px;
    margin: 0 auto;
    text-align: left;
}

.profile-info h3 {
    font-size: 1.8em;
    color: #003366;
    margin-bottom: 15px;
}

.profile-info p {
    font-size: 1.2em;
    color: #555;
    margin: 5px 0;
}

footer {
    background-color: #003366;
    color: white;
    text-align: center;
    padding: 15px 0;
    position: relative;
    bottom: 0;
    width: 100%;
    font-size: 0.9em;
    box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
}

/* Tombol */
button {
    background-color: #4c99ff; /* Biru terang */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #006bb3; /* Biru sedikit lebih gelap */
    transform: translateY(-2px);
}


    </style>
</head>
<body>
    <header>
        <h1>Pasar Santri</h1>
        <nav>
            <ul>
                <li><a href="user_home.php">Beranda</a></li>
                <li><a href="about_us.php">Tentang Kami</a></li>
                <li><a href="outlets.php">Outlet</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Profil User</h2>
        <p>Informasi profil user akan ditampilkan di sini.</p>
    </main>
</body>
</html>
