<?php
session_start();
if(isset($_SESSION['status']) && $_SESSION['status'] == "y"){
    header("Location:index.php");
    exit();
}

require "config.php";

$error   = "";
$success = "";

if(isset($_POST['register'])){
    $username       = trim($_POST['username']);
    $nama_lengkap   = trim($_POST['nama_lengkap']);
    $tanggal_lahir  = trim($_POST['tanggal_lahir']);
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $golongan_darah = $_POST['golongan_darah'];
    $alamat         = trim($_POST['alamat']);
    $pass           = $_POST['pass'];
    $pass_conf      = $_POST['pass_confirm'];

    if(empty($username) || empty($nama_lengkap) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($golongan_darah) || empty($alamat) || empty($pass)){
        $error = "Semua field wajib diisi.";
    } elseif(strlen($username) < 4){
        $error = "Username minimal 4 karakter.";
    } elseif(strlen($pass) < 6){
        $error = "Password minimal 6 karakter.";
    } elseif($pass !== $pass_conf){
        $error = "Konfirmasi password tidak sesuai.";
    } else {
        $username_esc       = mysqli_real_escape_string($conn, $username);
        $nama_lengkap_esc   = mysqli_real_escape_string($conn, $nama_lengkap);
        $tanggal_lahir_esc  = mysqli_real_escape_string($conn, $tanggal_lahir);
        $jenis_kelamin_esc  = mysqli_real_escape_string($conn, $jenis_kelamin);
        $golongan_darah_esc = mysqli_real_escape_string($conn, $golongan_darah);
        $alamat_esc         = mysqli_real_escape_string($conn, $alamat);

        $check = $conn->query("SELECT idusers FROM users WHERE username='$username_esc'");
        if($check->num_rows > 0){
            $error = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            $pass_md5 = md5($pass);

            // Simpan ke tabel users
            $sql = "INSERT INTO users (username, pass, role) VALUES ('$username_esc', '$pass_md5', 'Pasien')";
            if($conn->query($sql)){
                $idusers = $conn->insert_id;

                // Simpan data diri (nama, tanggal lahir, jenis kelamin, golongan darah, alamat) ke tabel pasien
                $sql2 = "INSERT INTO pasien (idusers, nama_lengkap, tanggal_lahir, jenis_kelamin, golongan_darah, alamat)
                         VALUES ('$idusers', '$nama_lengkap_esc', '$tanggal_lahir_esc', '$jenis_kelamin_esc', '$golongan_darah_esc', '$alamat_esc')";
                $conn->query($sql2);

                $success = "Registrasi berhasil! Silakan login dengan akun Anda.";
            } else {
                $error = "Terjadi kesalahan. Silakan coba lagi.";
            }
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SPFC</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <style>
        body { background: linear-gradient(135deg,#e8f4f8 0%,#d6eaf8 100%); min-height:100vh; font-family:'Segoe UI',sans-serif; }
        .register-wrapper { min-height:calc(100vh - 56px); display:flex; align-items:center; justify-content:center; padding:30px 15px; }
        .register-card { background:white; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.1); overflow:hidden; width:100%; max-width:460px; }
        .register-header { background:#007bff; color:white; padding:28px 30px; text-align:center; }
        .register-header i { font-size:40px; margin-bottom:10px; }
        .register-header h4 { margin:0; font-weight:700; font-size:1.3rem; }
        .register-header p { margin:5px 0 0; opacity:0.85; font-size:0.9rem; }
        .register-body { padding:30px; }
        .form-control { border-radius:8px; border:1.5px solid #dee2e6; padding:10px 14px; font-size:0.95rem; }
        .form-control:focus { border-color:#007bff; box-shadow:0 0 0 3px rgba(0,123,255,0.15); }
        .btn-register { width:100%; padding:11px; font-size:1rem; font-weight:600; border-radius:8px; margin-top:8px; }
        .login-link { text-align:center; margin-top:18px; font-size:0.9rem; color:#6c757d; }
        .login-link a { color:#007bff; font-weight:600; text-decoration:none; }
        label { font-weight:600; font-size:0.9rem; color:#495057; margin-bottom:5px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <a class="navbar-brand ml-3" href="welcome.php"><i class="fas fa-heartbeat mr-2"></i>SPFC</a>
    <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt mr-1"></i>Login</a></li>
        <li class="nav-item active"><a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-1"></i>Register</a></li>
    </ul>
</nav>

<div class="register-wrapper">
    <div class="register-card">
        <div class="register-header">
            <i class="fas fa-user-plus d-block"></i>
            <h4>Daftar Akun Pasien</h4>
            <p>Buat akun untuk mulai konsultasi</p>
        </div>
        <div class="register-body">

            <?php if($error): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endif; ?>

            <?php if($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle mr-2"></i><?php echo $success; ?>
                <div class="mt-2">
                    <a href="login.php" class="btn btn-success btn-sm"><i class="fas fa-sign-in-alt mr-1"></i>Login Sekarang</a>
                </div>
            </div>
            <?php else: ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label><i class="fas fa-id-card mr-1 text-primary"></i>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap"
                           placeholder="Masukkan nama lengkap Anda"
                           value="<?php echo isset($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : ''; ?>"
                           maxlength="100" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-calendar-alt mr-1 text-primary"></i>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir"
                           value="<?php echo isset($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : ''; ?>"
                           max="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-venus-mars mr-1 text-primary"></i>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" <?php echo (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin']=='L') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="P" <?php echo (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin']=='P') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-tint mr-1 text-primary"></i>Golongan Darah</label>
                    <select class="form-control" name="golongan_darah" required>
                        <option value="">-- Pilih --</option>
                        <?php foreach(['A','B','AB','O','-'] as $gd): ?>
                        <option value="<?php echo $gd; ?>" <?php echo (isset($_POST['golongan_darah']) && $_POST['golongan_darah']==$gd) ? 'selected' : ''; ?>>
                            <?php echo $gd == '-' ? 'Tidak Tahu' : $gd; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt mr-1 text-primary"></i>Alamat</label>
                    <textarea class="form-control" name="alamat" rows="2"
                              placeholder="Masukkan alamat lengkap" maxlength="200" required><?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-user mr-1 text-primary"></i>Username</label>
                    <input type="text" class="form-control" name="username"
                           placeholder="Buat username (min. 4 karakter)"
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                           maxlength="30" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock mr-1 text-primary"></i>Password</label>
                    <input type="password" class="form-control" name="pass"
                           placeholder="Buat password (min. 6 karakter)" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock mr-1 text-primary"></i>Konfirmasi Password</label>
                    <input type="password" class="form-control" name="pass_confirm"
                           placeholder="Ulangi password" maxlength="30" required>
                </div>
                <button type="submit" name="register" class="btn btn-primary btn-register">
                    <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                </button>
            </form>

            <?php endif; ?>

            <div class="login-link">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/all.js"></script>
</body>
</html>
