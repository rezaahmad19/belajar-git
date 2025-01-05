<?php
include 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$target_dir = "images/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $image = $_FILES['image']['name'];
    $target = $target_dir . basename($image);

    $sql = "INSERT INTO outlets (name, description, location, image) VALUES ('$name', '$description', '$location', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Outlet berhasil ditambahkan!";
        } else {
            echo "Gagal mengunggah gambar!";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<head>
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e9f2fd; /* Latar belakang biru muda */
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
    font-size: 1.1rem;
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
    width: 80%;
    max-width: 900px;
    margin: 40px auto;
}

main h2 {
    font-size: 2.5rem;
    color: #003366; /* Biru gelap */
    margin-bottom: 20px;
}

form {
    text-align: left;
    max-width: 700px;
    margin: 0 auto;
    background-color: #f1f1f1;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form label {
    font-size: 1.1rem;
    margin-bottom: 8px;
    display: block;
    color: #003366;
}

form input[type="text"], form textarea, form input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

form input[type="text"]:focus, form textarea:focus, form input[type="file"]:focus {
    border-color: #56ccf2; /* Highlight border color saat fokus */
}

form input[type="submit"] {
    background-color: #003366;
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 1.2rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

form input[type="submit"]:hover {
    background-color: #1a237e; /* Biru lebih gelap saat hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Footer */
footer {
    background-color: #003366;
    color: white;
    padding: 15px;
    text-align: center;
    margin-top: 40px;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
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

    main h2 {
        font-size: 2rem;
    }

    form {
        padding: 15px;
        width: 90%;
    }

    form label {
        font-size: 1rem;
    }

    form input[type="text"], form textarea {
        font-size: 1rem;
    }

    form input[type="submit"] {
        font-size: 1rem;
    }
}

    </style>
</head>
<form method="post" action="add_outlet.php" enctype="multipart/form-data">
    Nama: <input type="text" name="name" required><br>
    Deskripsi: <textarea name="description" required></textarea><br>
    Lokasi: <input type="text" name="location" required><br>
    Gambar: <input type="file" name="image" required><br>
    <input type="submit" value="Tambah Outlet">
</form>
