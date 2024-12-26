<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Inisialisasi variabel agar tidak ada undefined variable warnings
$username = $email = "";
$password = $cpassword = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari input pengguna
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? hash('sha256', $_POST['password']) : '';
    $cpassword = isset($_POST['cpassword']) ? hash('sha256', $_POST['cpassword']) : '';

    if (!empty($username) && !empty($email) && !empty($password) && !empty($cpassword)) {
        if ($password === $cpassword) {
            // Cek apakah email sudah terdaftar
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if ($result && !$result->num_rows > 0) {
                // Simpan data pengguna baru
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                    $username = $email = "";
                } else {
                    echo "<script>alert('Woops! Terjadi kesalahan saat menyimpan data.')</script>";
                }
            } else {
                echo "<script>alert('Woops! Email sudah terdaftar.')</script>";
            }
        } else {
            echo "<script>alert('Password dan konfirmasi password tidak cocok!')</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Mahasiswa Register</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Anda sudah punya akun? <a href="index.php">Login</a></p>
        </form>
    </div>
</body>
</html>
 