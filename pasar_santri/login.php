<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statements untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Set sesi untuk pengguna yang berhasil login
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id']; // Simpan user_id di dalam sesi
            
            // Redirect ke halaman utama
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color: red;'>Password salah!</p>";
        }
    } else {
        echo "<p style='color: red;'>User tidak ditemukan!</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <style>
    /* Umum */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #6f7dff, #00bcd4);
    color: #fff;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}

/* Container Form Login */
.container {
    background-color: rgba(255, 255, 255, 0.9); /* Transparansi pada background */
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: left;
}

h2 {
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: 600;
}

/* Form Elements */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: all 0.3s ease-in-out;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #00bcd4;
    box-shadow: 0 0 10px rgba(0, 188, 212, 0.5);
}

/* Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 15px;
    background-color: #00bcd4;
    color: #fff;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

input[type="submit"]:hover {
    background-color: #0097a7;
    transform: translateY(-3px);
}

/* Error Message */
p {
    font-size: 14px;
    color: red;
    margin-top: 10px;
}

/* Link Button */
a {
    color: #00bcd4;
    text-decoration: none;
    font-size: 16px;
    margin-top: 15px;
    display: inline-block;
    transition: color 0.3s ease;
}

a:hover {
    color: #0097a7;
}

/* Media Queries */
@media (max-width: 600px) {
    .container {
        padding: 20px;
        width: 80%;
    }

    h2 {
        font-size: 24px;
    }
}

   </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
   
    <form method="post" action="login.php">
    <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
