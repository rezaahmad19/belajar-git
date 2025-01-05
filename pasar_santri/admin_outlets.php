<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
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
    <title>Daftar Outlet Admin</title>
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f8fc; /* Latar belakang putih cerah */
    color: #333;
    margin: 0;
    padding: 0;
}

header {
    background-color: #003366; /* Biru gelap untuk header */
    color: white;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut untuk header */
}

header h1 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 700;
    letter-spacing: 1px;
}

/* Navigation Styles */
nav ul {
    list-style-type: none;
    padding: 0;
    margin-top: 10px;
    display: flex;
    justify-content: center;
    gap: 30px;
}

nav ul li {
    display: inline;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 1.1rem;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

nav ul li a:hover {
    background-color: #56ccf2; /* Biru terang saat hover */
    transform: scale(1.05); /* Efek zoom pada hover */
}

/* Main Content */
main {
    padding: 40px;
    margin: 20px auto;
    background-color: white;
    max-width: 1200px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan halus di sekitar konten */
    text-align: center;
}

main h2 {
    font-size: 2.5rem;
    color: #003366;
    margin-bottom: 20px;
}

main p {
    font-size: 1.2rem;
    line-height: 1.6;
    color: #666;
    max-width: 800px;
    margin: 0 auto;
}

/* Outlet List */
.outlet {
    background-color: #ffffff;
    padding: 20px;
    margin: 20px 0;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    transition: box-shadow 0.3s ease;
    text-align: left;
}

.outlet:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Efek hover pada outlet */
}

.outlet h3 {
    font-size: 1.8rem;
    color: #003366;
    margin-bottom: 10px;
    font-weight: 600;
}

.outlet p {
    font-size: 1rem;
    color: #666;
    margin: 5px 0;
}

/* Outlet List */
.outlet img {
    max-width: 80%; /* Mengatur lebar gambar menjadi 80% dari elemen kontainer */
    height: auto;
    border-radius: 8px;
    margin-top: 15px;
    display: block; /* Menghindari adanya spasi di bawah gambar */
    margin-left: auto; /* Mengatur margin kiri otomatis untuk membuat gambar terpusat */
    margin-right: auto; /* Mengatur margin kanan otomatis untuk membuat gambar terpusat */


}

.outlet a {
    color: #003366;
    text-decoration: none;
    font-size: 1rem;
    padding: 6px 12px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.outlet a:hover {
    background-color: #56ccf2;
    color: white;
}

/* Edit and Delete Buttons */
.btn-edit, .btn-delete {
    font-size: 1rem;
    padding: 8px 16px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    margin-right: 10px;
    transition: background-color 0.3s ease;
}

.btn-edit {
    background-color: #56ccf2;
}

.btn-delete {
    background-color: #f44336; /* Merah untuk tombol Hapus */
}

.btn-edit:hover {
    background-color: #3388cc;
}

.btn-delete:hover {
    background-color: #d32f2f;
}

/* Footer Styles */
footer {
    background-color: #003366;
    color: white;
    padding: 20px;
    text-align: center;
    margin-top: 40px;
    box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut di footer */
}

footer p {
    font-size: 1rem;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    header h1 {
        font-size: 2rem;
    }

    nav ul {
        flex-direction: column;
        gap: 15px;
    }

    main h2 {
        font-size: 2rem;
    }

    .outlet h3 {
        font-size: 1.5rem;
    }

    .outlet p {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <header>
        <h1>Pasar Santri</h1>
        <nav>
            <ul>
                <li><a href="admin_home.php">Beranda</a></li>
                <li><a href="admin_profile.php">Edit Profil</a></li>
                <li><a href="add_outlet.php">Tambah Outlet</a></li>
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
                echo "<a href='edit_outlet.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_outlet.php?id=" . $row["id"] . "'>Hapus</a>";
                echo "</div>";
            }
        } else {
            echo "<p>0 hasil</p>";
        }
        ?>
    </main>
</body>
</html>
