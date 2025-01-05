<?php
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT o.*, u.name AS outlet_name FROM orders o JOIN outlets u ON o.outlet_id = u.id WHERE o.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <style>
        /* Global Styles */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #e8f2fd; /* Latar belakang biru muda */
    color: #333;
}

h1, h2, h3 {
    color: #003366; /* Biru gelap untuk judul */
}

/* Container */
.container {
    width: 80%;
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan lembut untuk konten */
    text-align: center;
}

/* Title */
.container h2 {
    font-size: 2.5rem;
    color: #003366; /* Biru gelap */
    margin-bottom: 20px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 15px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 1.1rem;
}

table th {
    background-color: #003366; /* Biru gelap */
    color: white;
    font-size: 1.2rem;
}

table tr:nth-child(even) {
    background-color: #f5f9fc; /* Latar belakang baris genap */
}

table tr:hover {
    background-color: #d6e9ff; /* Highlight baris saat hover */
}

/* Button Styles */
.btn {
    background-color: #56ccf2; /* Biru terang */
    color: white;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 5px;
    font-size: 1.1rem;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background-color: #3388cc; /* Biru gelap saat hover */
    transform: scale(1.05); /* Efek zoom saat hover */
}

.btn-secondary {
    background-color: #f44336; /* Merah untuk tombol kembali */
    color: white;
}

.btn-secondary:hover {
    background-color: #d32f2f;
}

/* Alert Box */
.alert {
    background-color: #f8d7da;
    color: #721c24;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
}

/* Footer */
footer {
    background-color: #003366; /* Biru gelap */
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
    .container {
        width: 95%;
    }

    .container h2 {
        font-size: 2rem;
    }

    table th, table td {
        font-size: 1rem;
        padding: 10px;
    }

    table {
        font-size: 0.9rem;
    }

    .btn {
        padding: 10px 18px;
        font-size: 1rem;
    }

    .btn-secondary {
        padding: 10px 18px;
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pesanan Saya</h2>
        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>outlet_namet</th>
                        <th>quantity</th>
                        <th>total_price</th>
                        <th>payment_method</th>
                        <th>status</th>
                        <th>order_date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['outlet_name']); ?></td>
                            <td><?= htmlspecialchars($order['quantity']); ?></td>
                            <td><?= number_format($order['total_price'], 2, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($order['payment_method']); ?></td>
                            <td><?= htmlspecialchars($order['status']); ?></td>
                            <td><?= htmlspecialchars($order['order_date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada pesanan.</p>
        <?php endif; ?>
        <a href="outlets.php" class="btn btn-secondary">Kembali ke Outlet</a>
    </div>
</body>
</html>
