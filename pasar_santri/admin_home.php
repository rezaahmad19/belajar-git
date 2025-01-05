<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
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
    <title>Beranda Admin</title>
    <style>
        /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f8ff; /* Background putih dengan sentuhan biru muda */
    color: #333;
}

header {
    background-color: #003366; /* Biru gelap untuk header */
    color: white;
    padding: 20px 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan pada header */
}

header h1 {
    margin: 0;
    font-size: 2.5rem;
    letter-spacing: 1px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 15px 0 0;
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
    font-size: 1.2rem;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

nav ul li a:hover {
    background-color: #56ccf2; /* Biru terang saat hover */
    transform: scale(1.1); /* Efek zoom */
}

/* Main Content */
main {
    padding: 40px;
    text-align: center;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan halus pada konten */
    margin-top: 40px;
}

main h2 {
    font-size: 2.5rem;
    color: #003366; /* Biru gelap */
    margin-bottom: 20px;
}

main p {
    font-size: 1.2rem;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
    color: #555;
}

/* Buttons */
button {
    background-color: #003366; /* Biru gelap */
    color: white;
    border: none;
    padding: 12px 24px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 1.1rem;
    transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Bayangan tombol */
}

button:hover {
    background-color: #1a237e; /* Biru lebih gelap saat hover */
    transform: translateY(-3px); /* Efek angkat tombol */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam */
}

/* Footer */
footer {
    background-color: #003366; /* Warna biru gelap */
    color: white;
    padding: 15px;
    text-align: center;
    margin-top: 40px;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Bayangan footer */
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
        gap: 10px;
    }

    nav ul li {
        margin-bottom: 10px;
    }

    nav ul li a {
        font-size: 1.2rem;
    }

    main h2 {
        font-size: 2rem;
    }

    main p {
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
                <li><a href="admin_profile.php">Edit Profil</a></li>
                <li><a href="add_outlet.php">Tambah Outlet</a></li>
                <li><a href="admin_outlets.php">Outlet</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Selamat datang di Pasar Santri!</h2>
        <p>Ini adalah beranda admin. Anda dapat mengedit profil, menambah outlet, dan melihat daftar outlet dari sini.</p>

    </main>
    <footer>
        <p>&copy; 2025 Pasar Santri. Semua hak cipta dilindungi.</p>
    </footer>
</body>
</html>
