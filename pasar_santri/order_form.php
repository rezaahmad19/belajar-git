
<?php
session_start();
?>
<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['outlet_id'])) {
    header("Location: outlets.php");
    exit();
}

$outlet_id = $_GET['outlet_id'];

// Ambil detail outlet
$stmt = $conn->prepare("SELECT * FROM outlets WHERE id = ?");
$stmt->bind_param("i", $outlet_id);
$stmt->execute();
$outlet = $stmt->get_result()->fetch_assoc();
if (!$outlet) {
    header("Location: outlets.php?error=Outlet tidak ditemukan");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $payment_method = $_POST['payment_method'];
    $total_price = $outlet['price'] * $quantity; 
    $user_id = $_SESSION['user_id'];

    // Simpan pesanan ke database
    $stmt = $conn->prepare("INSERT INTO orders (user_id, outlet_id, quantity, total_price, payment_method, status, order_date) VALUES (?, ?, ?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("iiiss", $user_id, $outlet_id, $quantity, $total_price, $payment_method);
    
    if ($stmt->execute()) {
        header("Location: user_orders.php");
        exit();
    } else {
        $error = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan</title>
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f1f8ff; /* Latar belakang biru muda */
    color: #333;
}

/* Header */
header {
    background-color: #003366; /* Biru gelap untuk header */
    color: white;
    padding: 20px 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan lembut untuk header */
}

header h1 {
    margin: 0;
    font-size: 2.5rem;
    letter-spacing: 1px;
    font-weight: bold;
}

/* Navigation Bar */
nav ul {
    list-style-type: none;
    padding: 0;
    margin: 15px 0;
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
    padding: 12px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

nav ul li a:hover {
    background-color: #56ccf2; /* Biru terang saat hover */
    transform: scale(1.05); /* Efek zoom */
}

/* Main Content */
.container {
    width: 80%;
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan lembut untuk konten */
    text-align: center;
}

.container h2 {
    font-size: 2.5rem;
    color: #003366; /* Biru gelap */
    margin-bottom: 20px;
}

form {
    text-align: left;
    max-width: 700px;
    margin: 0 auto;
    background-color: #f9f9f9;
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

form input[type="number"], form select, form input[type="submit"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

form input[type="number"]:focus, form select:focus {
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

/* Button Styles */
.btn {
    background-color: #56ccf2;
    color: white;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #3388cc;
}

.btn-secondary {
    background-color: #f44336; /* Merah untuk tombol kembali */
}

.btn-secondary:hover {
    background-color: #d32f2f;
}

/* Footer */
footer {
    background-color: #003366;
    color: white;
    padding: 20px;
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
        gap: 15px;
    }

    .container h2 {
        font-size: 2rem;
    }

    form {
        padding: 15px;
        width: 90%;
    }

    form label {
        font-size: 1rem;
    }

    form input[type="number"], form select {
        font-size: 1rem;
    }

    form input[type="submit"] {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Pemesanan - <?= htmlspecialchars($outlet['name']); ?></h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="quantity">Jumlah:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <label for="payment_method">Metode Pembayaran:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
                <option value="Bayar di Tempat">Bayar di Tempat</option>
            </select>

            <button type="submit">Pesan</button>
        </form>
        <a href="outlets.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
