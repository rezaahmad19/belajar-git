<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil! Anda akan diarahkan ke halaman login.";
        header("refresh:2;url=login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<head>
   <style>
    /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(135deg, #6f7dff, #00bcd4);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
    text-align: center;
}

h2 {
    font-size: 2.5rem;
    margin-bottom: 30px;
    font-weight: bold;
    color: #5c6bc0;
}

/* Container for the form */
.container {
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    animation: fadeInUp 1s ease-out;
}

/* Form Inputs */
input[type="text"],
input[type="password"],
select {
    width: 100%;
    padding: 15px;
    margin: 15px 0;
    border: 2px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    font-size: 1rem;
    transition: all 0.3s ease-in-out;
}

input[type="text"]:focus,
input[type="password"]:focus,
select:focus {
    border-color: #5c6bc0;
    box-shadow: 0 0 10px rgba(92, 107, 192, 0.5);
    outline: none;
}

/* Submit Button */
input[type="submit"] {
    width: 100%;
    padding: 15px;
    background: #5c6bc0;
    color: #fff;
    font-size: 1.1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease, background 0.3s ease;
    letter-spacing: 1px;
}

input[type="submit"]:hover {
    background: #3949ab;
    transform: translateY(-3px);
}

/* Success/Error Messages */
.success-message {
    color: #4caf50;
    font-size: 1.1rem;
    margin-top: 10px;
}

.error-message {
    color: #f44336;
    font-size: 1.1rem;
    margin-top: 10px;
}

/* Link Button */
a {
    color: #5c6bc0;
    text-decoration: none;
    font-size: 1.1rem;
    margin-top: 15px;
    display: inline-block;
    transition: color 0.3s ease;
}

a:hover {
    color: #3949ab;
}

/* Animations */
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        padding: 20px;
        width: 80%;
    }

    h2 {
        font-size: 2rem;
    }
}

   </style>
</head>
<form method="post" action="register.php">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role: 
    <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br>
    <input type="submit" value="Register">
</form>
