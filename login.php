<?php
require 'function.php';

// Cek login terdaftar
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Pencocokan dengan database
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
    // Penghitungan jumlah data
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $_SESSION['log'] = 'true';
        header('location:index.php'); // Ubah ke index.php
    } else {
        // Tambahkan pesan error
        $error_message = "Invalid email or password. Please try again.";
    }
}

if (isset($_SESSION['log'])) {
    header('location:index.php');
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form Animation CSS | Codehal</title>
    <link rel="stylesheet" href="styleslogin.css">
</head>
<body>
    <div class="container flex-center">
        <div class="login-box">
            <h2>Login</h2>
            <!-- Tambahkan method="post" dan action="#" pada form -->
            <form method="post" action="#">
                <!-- Tambahkan name="email" pada input -->
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <!-- Tambahkan name="password" pada input -->
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <!-- Ganti class "btn" menjadi "btn-login" -->
                <!-- Tambahkan name="login" pada tombol aksi -->
                <div class="forgot-pass">
                    <button type="submit" class="btn btn-login" name="login">Login</button>
                </div>
                
                <!-- Tambahkan class "signup-link" pada div -->
                <div class="signup-link">
                    <a href="#">Signup</a>
                </div>
            </form>
        </div>
        <!-- Tambahkan efek animasi span -->
        <div>
            <span style="--i:0;"></span>
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:5;"></span>
            <span style="--i:6;"></span>
            <span style="--i:7;"></span>
            <span style="--i:8;"></span>
            <span style="--i:9;"></span>
            <span style="--i:10;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:13;"></span>
            <span style="--i:14;"></span>
            <span style="--i:15;"></span>
            <span style="--i:16;"></span>
            <span style="--i:17;"></span>
            <span style="--i:18;"></span>
            <span style="--i:19;"></span>
            <span style="--i:20;"></span>
            <span style="--i:21;"></span>
            <span style="--i:22;"></span>
            <span style="--i:23;"></span>
            <span style="--i:24;"></span>
            <span style="--i:25;"></span>
            <span style="--i:26;"></span>
            <span style="--i:27;"></span>
            <span style="--i:28;"></span>
            <span style="--i:29;"></span>
            <span style="--i:30;"></span>
            <span style="--i:31;"></span>
            <span style="--i:32;"></span>
            <span style="--i:33;"></span>
            <span style="--i:34;"></span>
            <span style="--i:35;"></span>
            <span style="--i:36;"></span>
            <span style="--i:37;"></span>
            <span style="--i:38;"></span>
            <span style="--i:39;"></span>
            <span style="--i:40;"></span>
            <span style="--i:41;"></span>
            <span style="--i:42;"></span>
            <span style="--i:43;"></span>
            <span style="--i:44;"></span>
            <span style="--i:45;"></span>
            <span style="--i:46;"></span>
            <span style="--i:47;"></span>
            <span style="--i:48;"></span>
            <span style="--i:49;"></span>
            <!-- ... tambahkan lebih banyak span sesuai kebutuhan ... -->
        </div>
    </div>
</body>
</html>
