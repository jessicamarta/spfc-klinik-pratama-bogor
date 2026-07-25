<!--proses menampilkan data hasil konsultasi untuk Perawat-->
<?php 
$idkonsultasi = intval($_GET['id']);

$sql    = "SELECT konsultasi.*, pasien.nama_lengkap AS nama
           FROM konsultasi
           INNER JOIN pasien ON konsultasi.idusers = pasien.idusers
           WHERE idkonsultasi='$idkonsultasi'";
$result = $conn->query($sql);
$row    = $result->fetch_assoc();

// Hitung IMT
$imt = null;
$imt_kategori = '';
if(!empty($row['berat_badan']) && !empty($row['tinggi_badan']) && $row['tinggi_badan'] > 0){
    $tb_m = $row['tinggi_badan'] / 100;
    $imt  = round($row['berat_badan'] / ($tb_m * $tb_m), 1);
    if($imt < 18.5)      $imt_kategori = 'Berat Badan Kurang';
    elseif($imt < 25.0)  $imt_kategori = 'Normal';
    elseif($imt < 30.0)  $imt_kategori = 'Kelebihan Berat Badan';
    else                 $imt_kategori = 'Obesitas';
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center no-print">
                <strong><i class="fas fa-file-medical-alt mr-2"></i>Detail Hasil Konsultasi Pasien</strong>
                <button type="button" class="btn btn-light btn-sm" onclick="window.print()">
                    <i class="fas fa-print mr-1"></i>Print
                </button>
            </div>
            <div class="card-body">

                <!-- Judul ini hanya muncul saat di-print, karena header kartu di atas disembunyikan -->
                <div class="print-only text-center mb-3">
                    <h4 class="font-weight-bold mb-0">Klinik Pratama Bogor</h4>
                    <p class="mb-0">Hasil Konsultasi Diagnosa Penyakit — Sistem Pakar Forward Chaining</p>
                    <p class="text-muted small">Dicetak pada: <?php echo date('d/m/Y H:i'); ?></p>
                    <hr>
                </div>

                <!-- DATA DIRI PASIEN -->
                <h6 class="font-weight-bold text-primary mb-3">
                    <i class="fas fa-user mr-2"></i>Data Diri Pasien
                </h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="160px" class="text-muted">Nama Lengkap</td>
                                <td>: <strong><?php echo htmlspecialchars($row['nama']); ?></strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Usia</td>
                                <td>: <?php echo isset($row['usia']) ? $row['usia'] : '-'; ?> tahun</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis Kelamin</td>
                                <td>: <?php echo $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : ($row['jenis_kelamin'] == 'P' ? 'Perempuan' : '-'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Golongan Darah</td>
                                <td>: <?php echo !empty($row['golongan_darah']) ? $row['golongan_darah'] : '-'; ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal Konsultasi</td>
                                <td>: <?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="160px" class="text-muted">Berat Badan</td>
                                <td>: <?php echo !empty($row['berat_badan']) ? $row['berat_badan'] . ' kg' : '-'; ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tinggi Badan</td>
                                <td>: <?php echo !empty($row['tinggi_badan']) ? $row['tinggi_badan'] . ' cm' : '-'; ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">IMT</td>
                                <td>: <?php echo $imt ? $imt . ' kg/m² (' . $imt_kategori . ')' : '-'; ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td>: <?php echo !empty($row['alamat']) ? htmlspecialchars($row['alamat']) : '-'; ?></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- GEJALA YANG DIPILIH -->
                <h6 class="font-weight-bold text-primary mb-3">
                    <i class="fas fa-clipboard-list mr-2"></i>Gejala yang Dilaporkan Pasien
                </h6>
                <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th width="50px">No.</th>
                            <th>Nama Gejala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no  = 1;
                            $sql = "SELECT detail_konsultasi.idgejala, gejala.nmgejala
                                    FROM detail_konsultasi INNER JOIN gejala 
                                    ON detail_konsultasi.idgejala = gejala.idgejala
                                    WHERE idkonsultasi='$idkonsultasi'";
                            $result = $conn->query($sql);
                            while($row2 = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row2['nmgejala']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>

                <hr>

                <!-- HASIL DIAGNOSA -->
                <h6 class="font-weight-bold text-primary mb-3">
                    <i class="fas fa-diagnoses mr-2"></i>Hasil Diagnosa Sistem
                </h6>

                <?php
                    $sql = "SELECT detail_penyakit.idpenyakit, penyakit.nmpenyakit,
                                   penyakit.keterangan, penyakit.solusi, detail_penyakit.persentase,
                                   (SELECT COUNT(dba.idgejala)
                                    FROM basis_aturan ba
                                    INNER JOIN detail_basis_aturan dba ON ba.idaturan = dba.idaturan
                                    WHERE ba.idpenyakit = detail_penyakit.idpenyakit) AS jml_gejala_aturan
                            FROM detail_penyakit INNER JOIN penyakit 
                            ON detail_penyakit.idpenyakit = penyakit.idpenyakit
                            WHERE idkonsultasi='$idkonsultasi'
                            ORDER BY persentase DESC, jml_gejala_aturan DESC, penyakit.nmpenyakit ASC";
                    $result = $conn->query($sql);

                    if($result->num_rows == 0):
                ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        Tidak ada penyakit yang terdeteksi dari konsultasi ini.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50px">No.</th>
                                <th width="180px">Nama Penyakit</th>
                                <th width="110px" class="text-center">Kecocokan (%)</th>
                                <th>Keterangan</th>
                                <th>Solusi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                while($row3 = $result->fetch_assoc()){
                                    $persen = $row3['persentase'];
                                    $badgeClass = $persen >= 80 ? 'danger' : ($persen >= 50 ? 'warning' : 'secondary');
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row3['nmpenyakit']); ?></td>
                                <td class="text-center">
                                    <span class="badge badge-<?php echo $badgeClass; ?> p-2">
                                        <?php echo $persen; ?>%
                                    </span>
                                </td>
                                <td><small><?php echo htmlspecialchars($row3['keterangan']); ?></small></td>
                                <td><small><?php echo htmlspecialchars($row3['solusi']); ?></small></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                <?php endif; ?>

                <?php $conn->close(); ?>

                <a class="btn btn-secondary no-print" href="?page=konsultasiadm">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
