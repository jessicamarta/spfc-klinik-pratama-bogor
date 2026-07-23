<!--proses menampilkan data hasil konsultasi pasien-->
<?php 
$idkonsultasi = intval($_GET['idkonsultasi']);

$sql    = "SELECT * FROM konsultasi WHERE idkonsultasi='$idkonsultasi'";
$result = $conn->query($sql);
$row    = $result->fetch_assoc();

// Hitung IMT jika data tersedia
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
            <div class="card-header bg-primary text-white">
                <strong><i class="fas fa-file-medical-alt mr-2"></i>Hasil Konsultasi</strong>
            </div>
            <div class="card-body">

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
                                <td>: <?php echo $row['usia'] ?? '-'; ?> tahun</td>
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
                    <i class="fas fa-clipboard-list mr-2"></i>Gejala yang Dipilih
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
                    <i class="fas fa-diagnoses mr-2"></i>Hasil Diagnosa Penyakit
                </h6>

                <?php
                    $sql = "SELECT detail_penyakit.idpenyakit, penyakit.nmpenyakit,
                                   penyakit.keterangan, penyakit.solusi, detail_penyakit.persentase
                            FROM detail_penyakit INNER JOIN penyakit 
                            ON detail_penyakit.idpenyakit = penyakit.idpenyakit
                            WHERE idkonsultasi='$idkonsultasi'
                            ORDER BY persentase DESC";
                    $result = $conn->query($sql);
                    $totalRows = $result->num_rows;
                ?>

                <?php if($totalRows == 0): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        Tidak ada penyakit yang terdeteksi berdasarkan gejala yang dipilih.
                        Silakan konsultasikan langsung dengan perawat atau dokter di klinik.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="50px">No.</th>
                                <th width="180px">Nama Penyakit</th>
                                <th width="100px" class="text-center">Kecocokan</th>
                                <th>Keterangan</th>
                                <th>Solusi / Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                // Reset result pointer
                                $sql = "SELECT detail_penyakit.idpenyakit, penyakit.nmpenyakit,
                                               penyakit.keterangan, penyakit.solusi, detail_penyakit.persentase
                                        FROM detail_penyakit INNER JOIN penyakit 
                                        ON detail_penyakit.idpenyakit = penyakit.idpenyakit
                                        WHERE idkonsultasi='$idkonsultasi'
                                        ORDER BY persentase DESC";
                                $result = $conn->query($sql);
                                while($row3 = $result->fetch_assoc()){
                                    $persen = $row3['persentase'];
                                    $badgeClass = $persen >= 80 ? 'danger' : ($persen >= 50 ? 'warning' : 'secondary');
                            ?>
                            <tr <?php echo ($no == 1) ? 'class="table-warning font-weight-bold"' : ''; ?>>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <?php echo htmlspecialchars($row3['nmpenyakit']); ?>
                                    <?php if($no == 2): ?>
                                        <span class="badge badge-warning ml-1">Tertinggi</span>
                                    <?php endif; ?>
                                </td>
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

                    <div class="alert alert-warning mt-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Perhatian:</strong> Hasil ini adalah diagnosa awal berdasarkan gejala yang diinputkan.
                        Untuk kepastian, silakan periksakan diri langsung ke dokter atau perawat di Klinik Pratama Bogor.
                    </div>
                <?php endif; ?>

                <?php $conn->close(); ?>

            </div>
        </div>
    </div>
</div>
