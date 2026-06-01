<?php 

$idusers = intval($_GET['id']);

if(isset($_POST['update'])){
    $role = $_POST['role'];

    // Validasi role yang diizinkan
    $allowed_roles = ['Perawat', 'Pasien'];
    if(!in_array($role, $allowed_roles)){
        $role = 'Pasien';
    }

    $sql = "UPDATE users SET role='$role' WHERE idusers='$idusers'";
    if($conn->query($sql) === TRUE){
        header("Location:?page=users");
        exit();
    }
}

$sql    = "SELECT * FROM users WHERE idusers='$idusers'";
$result = $conn->query($sql);
$row    = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white border-dark">
                    <strong><i class="fas fa-user-edit mr-2"></i>Update Data Users</strong>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control"
                               value="<?php echo htmlspecialchars($row['username']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control"
                               placeholder="Password tidak ditampilkan" readonly>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control chosen" data-placeholder="Pilih Role" name="role">
                            <option value="Perawat" <?php echo $row['role'] == 'Perawat' ? 'selected' : ''; ?>>Perawat</option>
                            <option value="Pasien"  <?php echo $row['role'] == 'Pasien'  ? 'selected' : ''; ?>>Pasien</option>
                        </select>
                    </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=users">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>
