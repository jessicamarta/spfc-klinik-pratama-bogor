<?php
date_default_timezone_set("Asia/Jakarta");

// Ambil nama lengkap pasien dari tabel pasien berdasarkan idusers session
$idusers = $_SESSION['idusers'];
$sql_nama = "SELECT nama_lengkap FROM pasien WHERE idusers='$idusers'";
$result_nama = $conn->query($sql_nama);
$row_nama = $result_nama->fetch_assoc();
$nama_pasien = $row_nama ? $row_nama['nama_lengkap'] : '';

if(isset($_POST['proses'])){
    $nmpasien       = mysqli_real_escape_string($conn, $nama_pasien);
    $usia           = intval($_POST['usia']);
    $alamat         = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $berat_badan    = floatval($_POST['berat_badan']);
    $tinggi_badan   = floatval($_POST['tinggi_badan']);
    $golongan_darah = mysqli_real_escape_string($conn, $_POST['golongan_darah']);
    $tgl            = date("Y-m-d");

    // Simpan konsultasi
    $sql = "INSERT INTO konsultasi (idusers, tanggal, nama, usia, alamat, berat_badan, tinggi_badan, golongan_darah)
            VALUES ('$idusers', '$tgl', '$nmpasien', '$usia', '$alamat', '$berat_badan', '$tinggi_badan', '$golongan_darah')";
    mysqli_query($conn, $sql);

    // Ambil idkonsultasi yang baru dibuat
    $idkonsultasi = $conn->insert_id;

    // Simpan semua gejala yang dipilih
    $idgejala = $_POST['idgejala'];
    $jumlah   = count($idgejala);
    for($i = 0; $i < $jumlah; $i++){
        $idgejalane = intval($idgejala[$i]);
        $sql = "INSERT INTO detail_konsultasi VALUES ('$idkonsultasi','$idgejalane')";
        mysqli_query($conn, $sql);
    }

    // ===== Forward Chaining =====
    $sql    = "SELECT * FROM penyakit";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $idpenyakit = $row['idpenyakit'];
        $jyes       = 0;

        // Hitung jumlah gejala di basis aturan untuk penyakit ini
        $sql2    = "SELECT COUNT(idpenyakit) AS jml_gejala 
                    FROM basis_aturan INNER JOIN detail_basis_aturan
                    ON basis_aturan.idaturan = detail_basis_aturan.idaturan
                    WHERE idpenyakit='$idpenyakit'";
        $result2 = $conn->query($sql2);
        $row2    = $result2->fetch_assoc();
        $jml_gejala = $row2['jml_gejala'];

        // Bandingkan gejala basis aturan dengan gejala yang dipilih pasien
        $sql3    = "SELECT idgejala 
                    FROM basis_aturan INNER JOIN detail_basis_aturan
                    ON basis_aturan.idaturan = detail_basis_aturan.idaturan
                    WHERE idpenyakit='$idpenyakit'";
        $result3 = $conn->query($sql3);
        while($row3 = $result3->fetch_assoc()){
            $idgejalane = $row3['idgejala'];
            $sql4    = "SELECT idgejala FROM detail_konsultasi
                        WHERE idkonsultasi='$idkonsultasi' AND idgejala='$idgejalane'";
            $result4 = $conn->query($sql4);
            if($result4->num_rows > 0) $jyes++;
        }

        // Hitung persentase kecocokan
        $peluang = ($jml_gejala > 0) ? round(($jyes / $jml_gejala) * 100, 2) : 0;

        // Simpan jika ada kecocokan
        if($peluang > 0){
            $sql = "INSERT INTO detail_penyakit VALUES ('$idkonsultasi','$idpenyakit','$peluang')";
            mysqli_query($conn, $sql);
        }
    }

    // Tutup koneksi SETELAH semua proses selesai
    $conn->close();

    header("Location:?page=konsultasi&action=hasil&idkonsultasi=$idkonsultasi");
    exit();
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <strong><i class="fas fa-notes-medical mr-2"></i>Form Konsultasi Penyakit</strong>
                </div>
                <div class="card-body">

                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-user mr-2"></i>Data Diri Pasien
                    </h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control bg-light"
                                       value="<?php echo htmlspecialchars($nama_pasien); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Usia (tahun) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="usia"
                                       placeholder="Contoh: 25" min="1" max="120" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Golongan Darah <span class="text-danger">*</span></label>
                                <select class="form-control" name="golongan_darah" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="-">Tidak Tahu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Berat Badan (kg) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                       placeholder="Contoh: 60" step="0.1" min="1" max="300" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tinggi Badan (cm) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                       placeholder="Contoh: 165" step="0.1" min="1" max="300" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="alamat"
                                       placeholder="Masukkan alamat lengkap" maxlength="200" required>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info py-2 px-3 mb-3" id="imt-info" style="display:none;">
                        <small>
                            <i class="fas fa-calculator mr-1"></i>
                            <strong>IMT:</strong>
                            <span id="imt-value">-</span>
                            <span id="imt-kategori" class="ml-2 font-weight-bold"></span>
                        </small>
                    </div>

                    <hr>

                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-clipboard-check mr-2"></i>Pilih Gejala yang Anda Rasakan
                    </h6>
                    <p class="text-muted small mb-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        Centang semua gejala yang sesuai dengan kondisi Anda saat ini.
                    </p>

                    <table class="table table-bordered table-hover" id="myTable">
                        <thead class="thead-light">
                            <tr>
                                <th width="50px" class="text-center">Pilih</th>
                                <th width="50px">No.</th>
                                <th>Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no  = 1;
                                $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="check-item"
                                           name="idgejala[]"
                                           value="<?php echo $row['idgejala']; ?>">
                                </td>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nmgejala']); ?></td>
                            </tr>
                            <?php } ?>
                            <!-- $conn->close() DIHAPUS dari sini -->
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-lg" type="submit" name="proses">
                        <i class="fas fa-search mr-2"></i>Proses Konsultasi
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('berat_badan').addEventListener('input', hitungIMT);
    document.getElementById('tinggi_badan').addEventListener('input', hitungIMT);

    function hitungIMT(){
        var bb = parseFloat(document.getElementById('berat_badan').value);
        var tb = parseFloat(document.getElementById('tinggi_badan').value) / 100;
        if(bb > 0 && tb > 0){
            var imt = (bb / (tb * tb)).toFixed(1);
            var kategori = "";
            if(imt < 18.5)      kategori = '<span class="text-warning">Berat Badan Kurang</span>';
            else if(imt < 25.0) kategori = '<span class="text-success">Normal</span>';
            else if(imt < 30.0) kategori = '<span class="text-warning">Kelebihan Berat Badan</span>';
            else                kategori = '<span class="text-danger">Obesitas</span>';
            document.getElementById('imt-value').innerText = imt + ' kg/m²';
            document.getElementById('imt-kategori').innerHTML = '— ' + kategori;
            document.getElementById('imt-info').style.display = 'block';
        }
    }

    function validasiForm(){
        var checkbox  = document.getElementsByName('idgejala[]');
        var isChecked = false;
        for(var i = 0; i < checkbox.length; i++){
            if(checkbox[i].checked){ isChecked = true; break; }
        }
        if(!isChecked){ alert('Pilih setidaknya satu gejala!'); return false; }
        return true;
    }
</script>
