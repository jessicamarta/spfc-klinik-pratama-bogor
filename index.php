<?php
session_start();
include "config.php";

// Cek status login — redirect ke welcome jika belum login
if(!isset($_SESSION['status']) || $_SESSION['status'] != "y"){
    header("Location:welcome.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a class="navbar-brand ml-2" href="index.php">
        <i class="fas fa-heartbeat mr-1"></i>SPFC
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav mr-auto">

            <?php if($_SESSION['role'] == "Perawat"): ?>

                <!-- Menu Perawat: kelola gejala, penyakit, basis aturan + lihat konsultasi -->
                <li class="nav-item">
                    <a class="nav-link" href="?page=gejala">
                        <i class="fas fa-list-alt mr-1"></i>Gejala
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=penyakit">
                        <i class="fas fa-disease mr-1"></i>Penyakit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=aturan">
                        <i class="fas fa-sitemap mr-1"></i>Basis Aturan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=konsultasiadm">
                        <i class="fas fa-clipboard-list mr-1"></i>Data Konsultasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=users">
                        <i class="fas fa-users mr-1"></i>Users
                    </a>
                </li>

            <?php elseif($_SESSION['role'] == "Pasien"): ?>

                <!-- Menu Pasien: hanya konsultasi -->
                <li class="nav-item">
                    <a class="nav-link" href="?page=konsultasi">
                        <i class="fas fa-notes-medical mr-1"></i>Konsultasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=riwayat">
                        <i class="fas fa-history mr-1"></i>Riwayat Konsultasi
                    </a>
                </li>

            <?php endif; ?>

        </ul>

        <ul class="navbar-nav ml-auto mr-2">
            <li class="nav-item">
                <span class="nav-link text-light">
                    <i class="fas fa-user-circle mr-1"></i>
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                    <span class="badge badge-light ml-1"><?php echo $_SESSION['role']; ?></span>
                </span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=logout">
                    <i class="fas fa-sign-out-alt mr-1"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Container -->
<div class="container mt-3 mb-4">

    <?php
    $page   = isset($_GET['page'])   ? $_GET['page']   : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if($page == ""){
        // Halaman beranda setelah login
        ?>
        <div class="jumbotron text-center mt-3" style="background: linear-gradient(135deg,#e8f4f8,#d6eaf8); border-radius:12px;">
            <h2 class="display-5 font-weight-bold text-primary">
                <i class="fas fa-heartbeat mr-2"></i>Selamat Datang
            </h2>
            <p class="lead">
                Halo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
                Anda login sebagai <span class="badge badge-primary"><?php echo $_SESSION['role']; ?></span>
            </p>
            <hr>
            <h5 class="text-secondary">Sistem Pakar Diagnosa Awal Penyakit</h5>
            <p class="text-muted">Metode Forward Chaining — Klinik Pratama Bogor</p>
            <?php if($_SESSION['role'] == "Pasien"): ?>
            <a href="?page=konsultasi" class="btn btn-primary btn-lg mt-2">
                <i class="fas fa-notes-medical mr-2"></i>Mulai Konsultasi
            </a>
            <?php endif; ?>
        </div>
        <?php

    // ==================== MENU GEJALA (Perawat only) ====================
    } elseif($page == "gejala" && $_SESSION['role'] == "Perawat"){
        if($action == "")           include "tampil_gejala.php";
        elseif($action == "tambah") include "tambah_gejala.php";
        elseif($action == "update") include "update_gejala.php";
        else                        include "hapus_gejala.php";

    // ==================== MENU PENYAKIT (Perawat only) ====================
    } elseif($page == "penyakit" && $_SESSION['role'] == "Perawat"){
        if($action == "")           include "tampil_penyakit.php";
        elseif($action == "tambah") include "tambah_penyakit.php";
        elseif($action == "update") include "update_penyakit.php";
        else                        include "hapus_penyakit.php";

    // ==================== MENU BASIS ATURAN (Perawat only) ====================
    } elseif($page == "aturan" && $_SESSION['role'] == "Perawat"){
        if($action == "")                  include "tampil_aturan.php";
        elseif($action == "tambah")        include "tambah_aturan.php";
        elseif($action == "detail")        include "detail_aturan.php";
        elseif($action == "update")        include "update_aturan.php";
        elseif($action == "hapus_gejala")  include "hapus_detail_aturan.php";
        else                               include "hapus_aturan.php";

    // ==================== MENU DATA KONSULTASI ADMIN (Perawat only) ====================
    } elseif($page == "konsultasiadm" && $_SESSION['role'] == "Perawat"){
        if($action == "") include "tampil_konsultasiadm.php";
        else              include "detail_konsultasiadm.php";

    // ==================== MENU USERS (Perawat only) ====================
    } elseif($page == "users" && $_SESSION['role'] == "Perawat"){
        if($action == "")           include "tampil_users.php";
        elseif($action == "tambah") include "tambah_users.php";
        elseif($action == "update") include "update_users.php";
        else                        include "hapus_users.php";

    // ==================== MENU KONSULTASI (Pasien only) ====================
    } elseif($page == "konsultasi" && $_SESSION['role'] == "Pasien"){
        if($action == "") include "tampil_konsultasi.php";
        else              include "hasil_konsultasi.php";

    // ==================== RIWAYAT KONSULTASI (Pasien only) ====================
    } elseif($page == "riwayat" && $_SESSION['role'] == "Pasien"){
        include "riwayat_konsultasi.php";

    // ==================== LOGOUT ====================
    } elseif($page == "logout"){
        include "logout.php";

    // ==================== AKSES TIDAK SAH ====================
    } else {
        echo '<div class="alert alert-warning mt-3">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                Halaman tidak ditemukan atau Anda tidak memiliki akses ke halaman ini.
              </div>';
    }
    ?>

</div>

<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
            }
        });
    });
</script>
<script src="assets/js/all.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script>
    $(function() {
        $('.chosen').chosen();
    });
</script>
</body>
</html>
