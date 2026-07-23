<?php
// Hanya tampilkan konsultasi milik pasien yang sedang login
$idusers = $_SESSION['idusers'];

$sql    = "SELECT * FROM konsultasi WHERE idusers='$idusers' ORDER BY tanggal DESC, idkonsultasi DESC";
$result = $conn->query($sql);
$data   = [];
while($row = $result->fetch_assoc()){
    $data[] = $row;
}
?>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white">
        <strong><i class="fas fa-history mr-2"></i>Riwayat Konsultasi Saya</strong>
    </div>
    <div class="card-body">

        <?php if(empty($data)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>
                Anda belum pernah melakukan konsultasi.
                <a href="?page=konsultasi" class="alert-link">Mulai konsultasi sekarang</a>.
            </div>
        <?php else: ?>
            <p class="text-muted small mb-3">
                <i class="fas fa-info-circle mr-1"></i>
                Menampilkan riwayat konsultasi Anda. Klik detail untuk melihat hasil lengkap.
            </p>
            <div class="table-responsive">
            <table class="table table-bordered" id="myTable">
                <thead class="thead-light">
                    <tr>
                        <th width="50px">No.</th>
                        <th width="120px">Tanggal</th>
                        <th>Nama Pasien</th>
                        <th width="80px" class="text-center">Usia</th>
                        <th width="60px" class="text-center">JK</th>
                        <th width="80px" class="text-center">Goldar</th>
                        <th width="100px" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($data as $row): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td class="text-center"><?php echo ($row['usia'] > 0) ? $row['usia'] . ' thn' : '-'; ?></td>
                        <td class="text-center"><?php echo !empty($row['jenis_kelamin']) ? $row['jenis_kelamin'] : '-'; ?></td>
                        <td class="text-center"><?php echo !empty($row['golongan_darah']) ? $row['golongan_darah'] : '-'; ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-sm"
                               href="?page=konsultasi&action=hasil&idkonsultasi=<?php echo $row['idkonsultasi']; ?>">
                                <i class="fas fa-eye mr-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>

        <?php $conn->close(); ?>

        <a href="?page=konsultasi" class="btn btn-primary mt-2">
            <i class="fas fa-plus mr-1"></i>Konsultasi Baru
        </a>
    </div>
</div>
