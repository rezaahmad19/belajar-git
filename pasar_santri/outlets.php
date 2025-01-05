<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM outlets";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Outlet</title>
    <style>
        /* Reset dasar */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f8ff; /* Biru sangat terang */
    color: #333; /* Warna teks netral */
}

header {
    background-color: #1e3a8a; /* Biru gelap */
    color: white; /* Teks putih */
    padding: 20px 0;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

header h1 {
    font-size: 2.5em;
    margin: 0;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 10px 0;
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
    background-color: #2563eb; /* Biru terang */
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
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
}

.outlet {
    background-color: #ffffff; /* Latar putih */
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: calc(33% - 20px); /* 3 kolom dengan jarak antar elemen */
    transition: transform 0.3s ease;
    text-align: center;
}

.outlet:hover {
    transform: scale(1.05);
}

.outlet img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.outlet h3 {
    font-size: 1.5em;
    color: #1e3a8a;
    margin-bottom: 10px;
}

.outlet p {
    color: #555;
    margin: 10px 0;
}

form {
    margin-top: 15px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #1e3a8a;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn:hover {
    background-color: #2563eb; /* Biru terang */
    transform: translateY(-3px);
}

footer {
    background-color: #1e3a8a;
    color: white;
    text-align: center;
    padding: 15px 0;
    position: relative;
    bottom: 0;
    width: 100%;
    font-size: 0.9em;
    box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.2);
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
                <li><a href="about_us.php">Tentang Kami</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Daftar Outlet</h2>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='outlet'>";
                echo "<h3>" . $row["name"] . "</h3>";
                echo "<p>Lokasi: " . $row["location"] . "</p>";
                echo "<p>Deskripsi: " . $row["description"] . "</p>";
                echo "<img src='images/" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "</div>";
                echo "<form method='GET' action='order_form.php'>";
                echo "<input type='hidden' name='outlet_id' value='" . $row['id'] . "'>";
                echo "<button type='submit'>Pesan Sekarang</button>";
                echo "</form>";

            }
        } else {
            echo "<p>0 hasil</p>";
        }
        ?>
    </main>
</body>
</html>
