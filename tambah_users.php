<?php

if(isset($_POST['simpan'])){
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $pass     = md5($_POST['pass']);
    $role     = $_POST['role'];

    // Validasi role yang diizinkan
    $allowed_roles = ['Perawat', 'Pasien'];
    if(!in_array($role, $allowed_roles)){
        $role = 'Pasien';
    }

    $sql = "INSERT INTO users (username, pass, role) VALUES ('$username','$pass','$role')";
    if($conn->query($sql) === TRUE){
        header("Location:?page=users");
        exit();
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white border-dark">
                    <strong><i class="fas fa-user-plus mr-2"></i>Tambah Data Users</strong>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" maxlength="30"
                               placeholder="Masukkan username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="pass" maxlength="30"
                               placeholder="Masukkan password" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control chosen" data-placeholder="Pilih Role" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="Perawat">Perawat</option>
                            <option value="Pasien">Pasien</option>
                        </select>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=users">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>
