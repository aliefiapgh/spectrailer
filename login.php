<?php
session_start();
include "koneksi/connection.php";
$password = password_hash("password123", PASSWORD_BCRYPT);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Cek password
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Admin atau user biasa

            echo "<script>alert('Login berhasil!'); window.location.href='../dashboard.php';</script>";
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Didot', 'serif';
        }

        body {
            background-color: #161A30;
            text-align: left;
            justify-content: center;
            color: white;
        }

        .body label{
            color: white;
        }

        header {
            background: linear-gradient(#161A30, #535C91);  
            color: white;
            padding: 30px;
            font-size: 24px;
            text-align: center;
            justify-content: center;
        }
        .login-container {
            background: #16213e;
            padding: 20px;
            border-radius: 10px;
            width: 30%;
            margin: 100px auto;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }
        button {
            width: 100%;
            padding: 10px;
            background: rgb(90, 47, 54);
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<header>
        <h1>Login</h1>
</header>
    <div class="login-container">
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
