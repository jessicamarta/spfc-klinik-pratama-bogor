<?php
session_start();
// Jika sudah login, redirect ke dashboard
if(isset($_SESSION['status']) && $_SESSION['status'] == "y"){
    header("Location:index.php");
    exit();
}

require "config.php";

if(isset($_POST["submit"])){
    $username = trim($_POST["username"]);
    $pass     = md5($_POST["pass"]);

    // Cek username dan password — hanya role Perawat dan Pasien
    $sql    = "SELECT * FROM users WHERE username='".mysqli_real_escape_string($conn, $username)."' AND pass='$pass' AND role IN ('Perawat','Pasien')";
    $result = $conn->query($sql);
    $row    = $result->fetch_assoc();

    if($result->num_rows > 0){
        $_SESSION['idusers']  = $row['idusers'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role']     = $row['role'];
        $_SESSION['status']   = "y";
        header("Location:index.php");
        exit();
    } else {
        header("Location:login.php?msg=n");
        exit();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPFC</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/mobile-fixes.css">
    <style>
        body {
            background: linear-gradient(135deg, #e8f4f8 0%, #d6eaf8 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-wrapper {
            min-height: calc(100vh - 56px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }
        .login-header {
            background: #007bff;
            color: white;
            padding: 28px 30px;
            text-align: center;
        }
        .login-header i {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .login-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
        }
        .login-header p {
            margin: 5px 0 0;
            opacity: 0.85;
            font-size: 0.9rem;
        }
        .login-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 8px;
            border: 1.5px solid #dee2e6;
            padding: 10px 14px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.15);
        }
        .btn-login {
            width: 100%;
            padding: 11px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            margin-top: 8px;
        }
        .register-link {
            text-align: center;
            margin-top: 18px;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .register-link a {
            color: #007bff;
            font-weight: 600;
            text-decoration: none;
        }
        label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #495057;
            margin-bottom: 5px;
        }
        .back-link {
            text-align: center;
            margin-top: 10px;
            font-size: 0.85rem;
        }
        .back-link a {
            color: #6c757d;
            text-decoration: none;
        }
        .back-link a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a class="navbar-brand ml-3" href="welcome.php">
        <i class="fas fa-heartbeat mr-2"></i>SPFC
    </a>
    <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item active">
            <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-1"></i>Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-1"></i>Register</a>
        </li>
    </ul>
</nav>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <i class="fas fa-stethoscope d-block"></i>
            <h4>Login SPFC</h4>
            <p>Sistem Pakar Penyakit Forward Chaining</p>
        </div>
        <div class="login-body">

            <?php if(isset($_GET['msg']) && $_GET['msg'] == "n"): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Login Gagal!</strong> Username atau password salah.
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label><i class="fas fa-user mr-1 text-primary"></i>Username</label>
                    <input type="text"
                           class="form-control"
                           name="username"
                           placeholder="Masukkan username"
                           autocomplete="off"
                           required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock mr-1 text-primary"></i>Password</label>
                    <input type="password"
                           class="form-control"
                           name="pass"
                           placeholder="Masukkan password"
                           autocomplete="off"
                           required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            <div class="register-link">
                Belum punya akun? <a href="register.php">Daftar di sini</a>
            </div>
            <div class="back-link">
                <a href="welcome.php"><i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/all.js"></script>
</body>
</html>
