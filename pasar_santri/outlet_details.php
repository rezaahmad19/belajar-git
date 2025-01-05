<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

// Mendapatkan ID outlet dari URL
if (isset($_GET['id'])) {
    $outlet_id = $_GET['id'];

    // Query untuk mengambil data outlet berdasarkan ID
    $outlet_query = "SELECT * FROM outlets WHERE id = ?";
    $stmt = mysqli_prepare($conn, $outlet_query);
    mysqli_stmt_bind_param($stmt, "i", $outlet_id);
    mysqli_stmt_execute($stmt);
    $outlet_result = mysqli_stmt_get_result($stmt);

    // Mengecek jika outlet ditemukan
    if (mysqli_num_rows($outlet_result) > 0) {
        $outlet = mysqli_fetch_assoc($outlet_result);
    } else {
        echo "Outlet tidak ditemukan.";
        exit();
    }
} else {
    echo "ID outlet tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Outlet</title>
    <link rel="stylesheet" href="style.css">
    <style>
      /* Global */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f8ff; /* Warna latar belakang biru muda */
    color: #333;
}

header, footer {
    background-color: #003366; /* Biru gelap untuk header dan footer */
    color: white;
    text-align: center;
    padding: 20px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek bayangan pada header/footer */
}

header h1, footer p {
    margin: 0;
    font-size: 2em; /* Menambah ukuran font untuk header dan footer */
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 10px 0 0;
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
    background-color: #4c99ff; /* Biru terang saat hover */
    transform: scale(1.1);
}

/* Outlet Details */
.outlet-details {
    background-color: white;
    margin: 20px auto;
    padding: 30px;
    width: 90%;
    max-width: 650px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Efek bayangan untuk elemen */
    transition: box-shadow 0.3s ease;
}

.outlet-details:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Efek bayangan lebih dalam saat hover */
}

.outlet-details h2 {
    color: #003366; /* Warna biru gelap untuk judul */
    margin-bottom: 15px;
    font-size: 2.5em; /* Ukuran font lebih besar */
}

.outlet-details p {
    color: #555;
    line-height: 1.6;
    font-size: 1.1em;
}

.outlet-details img {
    max-width: 100%;
    border-radius: 8px;
    margin: 20px 0;
    transition: transform 0.3s ease;
}

.outlet-details img:hover {
    transform: scale(1.05); /* Efek zoom pada gambar saat hover */
}

.outlet-details a {
    display: inline-block;
    background-color: #003366; /* Biru gelap */
    color: white;
    padding: 12px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.2em;
    text-align: center;
    margin-top: 20px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.outlet-details a:hover {
    background-color: #4c99ff; /* Biru terang saat hover */
    transform: translateY(-3px); /* Efek angkat saat hover */
}

/* Footer */
footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 10px 0;
    font-size: 1em;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    body {
        font-size: 14px; /* Ukuran font lebih kecil pada layar kecil */
    }

    .outlet-details {
        width: 95%; /* Lebih lebar di layar kecil */
    }

    nav ul {
        flex-direction: column;
    }

    nav ul li {
        margin-bottom: 10px;
    }

    header h1 {
        font-size: 1.5em; /* Ukuran font header lebih kecil pada layar kecil */
    }

    footer p {
        font-size: 0.9em; /* Ukuran font footer lebih kecil pada layar kecil */
    }
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
        <div class="outlet-details">
            <h2><?php echo $outlet['name']; ?></h2>
            <img src="images/<?php echo $outlet['image']; ?>" alt="Gambar Outlet">
            <p><strong>Deskripsi:</strong> <?php echo $outlet['description']; ?></p>
            <!-- Bisa menambahkan tombol atau aksi lainnya -->
            <a href="outlets.php" style="text-decoration: none; color: #fff; background-color: #333; padding: 10px 15px; border-radius: 5px;">Kembali ke Daftar Outlet</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Pasar Santri. Semua hak cipta dilindungi.</p>
    </footer>
</body>
</html>
