<!-- <h1 class="text-center">SELAMAT DATANG</h1>
<h3 class="text-center">SISTEM PAKAR PENYAKIT METODE FORWARD CHAINING</h3>
<H3 class="text-center">KLINIK PRATAMA BOGOR</H3> -->

<?php
session_start();
// Jika sudah login, redirect ke dashboard
if(isset($_SESSION['status']) && $_SESSION['status'] == "y"){
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC - Sistem Pakar Penyakit</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/mobile-fixes.css">
    <style>
        body {
            background: linear-gradient(135deg, #e8f4f8 0%, #d6eaf8 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .hero-section {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .hero-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 20px;
        }
        .hero-card {
            background: white;
            border-radius: 16px;
            padding: 50px 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .hero-icon {
            font-size: 64px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .hero-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
        }
        .hero-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .feature-list {
            text-align: left;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px 25px;
            margin-bottom: 30px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            padding: 6px 0;
            color: #495057;
            font-size: 0.95rem;
        }
        .feature-item i {
            color: #28a745;
            margin-right: 10px;
            width: 20px;
        }
        .btn-hero {
            padding: 12px 32px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
        }
        .clinic-badge {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<!-- Navbar Publik -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a class="navbar-brand ml-3" href="welcome.php">
        <i class="fas fa-heartbeat mr-2"></i>SPFC
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ml-auto mr-3">
            <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-1"></i>Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-1"></i>Register</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Hero Content -->
<div class="hero-content">
    <div class="hero-card">
        <div class="clinic-badge">Klinik Pratama Bogor</div>
        <div class="hero-icon">
            <i class="fas fa-stethoscope"></i>
        </div>
        <h1 class="hero-title">Sistem Pakar Diagnosa Penyakit</h1>
        <p class="hero-subtitle">
            Diagnosa awal penyakit berbasis web menggunakan metode <strong>Forward Chaining</strong>.
            Konsultasikan gejala Anda dan dapatkan rekomendasi penanganan.
        </p>

        <div class="feature-list">
            <div class="feature-item">
                <i class="fas fa-check-circle"></i>
                Deteksi dini lebih dari 30 jenis penyakit umum
            </div>
            <div class="feature-item">
                <i class="fas fa-check-circle"></i>
                Sistem berbasis aturan medis yang terstruktur
            </div>
            <div class="feature-item">
                <i class="fas fa-check-circle"></i>
                Hasil konsultasi lengkap beserta solusi penanganan
            </div>
            <div class="feature-item">
                <i class="fas fa-check-circle"></i>
                Data konsultasi tersimpan untuk ditinjau perawat
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <a href="register.php" class="btn btn-primary btn-hero mr-3">
                <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
            </a>
            <a href="login.php" class="btn btn-outline-primary btn-hero">
                <i class="fas fa-sign-in-alt mr-2"></i>Sudah Punya Akun
            </a>
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/all.js"></script>
</body>
</html>
