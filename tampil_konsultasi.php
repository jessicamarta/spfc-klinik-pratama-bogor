<?php
date_default_timezone_set("Asia/Jakarta");

// Ambil data diri pasien (data master) dari tabel pasien berdasarkan idusers session
$idusers = $_SESSION['idusers'];
$sql_pasien  = "SELECT nama_lengkap, tanggal_lahir, jenis_kelamin, golongan_darah, alamat
                FROM pasien WHERE idusers='$idusers'";
$result_pasien = $conn->query($sql_pasien);
$row_pasien    = $result_pasien->fetch_assoc();

$nama_pasien    = $row_pasien ? $row_pasien['nama_lengkap']   : '';
$tanggal_lahir  = $row_pasien ? $row_pasien['tanggal_lahir']  : '';
$jenis_kelamin  = $row_pasien ? $row_pasien['jenis_kelamin']  : '';
$golongan_darah = $row_pasien ? $row_pasien['golongan_darah'] : '';
$alamat_pasien  = $row_pasien ? $row_pasien['alamat']         : '';

// Hitung usia otomatis dari tanggal lahir (bukan input manual lagi)
$usia_terhitung = 0;
if(!empty($tanggal_lahir)){
    $tgl_lahir_obj  = new DateTime($tanggal_lahir);
    $usia_terhitung = $tgl_lahir_obj->diff(new DateTime())->y;
}

if(isset($_POST['proses'])){
    $nmpasien       = mysqli_real_escape_string($conn, $nama_pasien);
    $usia           = $usia_terhitung; // dihitung otomatis dari tanggal_lahir, bukan dari input pasien
    $jk             = mysqli_real_escape_string($conn, $jenis_kelamin);
    $alamat         = mysqli_real_escape_string($conn, trim($_POST['alamat'])); // boleh diedit pasien
    $berat_badan    = floatval($_POST['berat_badan']);
    $tinggi_badan   = floatval($_POST['tinggi_badan']);
    $golongan_darah_snap = mysqli_real_escape_string($conn, $golongan_darah); // dari data master, bukan input
    $tgl            = date("Y-m-d");

    // Jika pasien mengedit alamat, sinkronkan juga ke data master pasien
    if($alamat !== mysqli_real_escape_string($conn, $alamat_pasien)){
        $conn->query("UPDATE pasien SET alamat='$alamat' WHERE idusers='$idusers'");
    }

    // Simpan konsultasi (snapshot data diri pasien pada saat konsultasi ini dibuat)
    $sql_konsultasi = "INSERT INTO konsultasi (idusers, tanggal, nama, usia, jenis_kelamin, alamat, berat_badan, tinggi_badan, golongan_darah)
                       VALUES ('$idusers', '$tgl', '$nmpasien', '$usia', '$jk', '$alamat', '$berat_badan', '$tinggi_badan', '$golongan_darah_snap')";
    mysqli_query($conn, $sql_konsultasi);

    // Ambil idkonsultasi yang baru dibuat
    $idkonsultasi = $conn->insert_id;

    // ===== Simpan semua gejala yang dipilih =====
    // Kumpulkan dulu semua idgejala ke array, baru INSERT satu per satu
    $arr_idgejala = isset($_POST['idgejala']) ? $_POST['idgejala'] : [];
    foreach($arr_idgejala as $idgejalane){
        $idgejalane = intval($idgejalane);
        $sql_detail = "INSERT INTO detail_konsultasi (idkonsultasi, idgejala) VALUES ('$idkonsultasi', '$idgejalane')";
        mysqli_query($conn, $sql_detail);
    }

    // ===== Forward Chaining =====
    // Ambil semua penyakit ke array PHP terlebih dahulu
    $sql_penyakit = "SELECT idpenyakit FROM penyakit";
    $res_penyakit = $conn->query($sql_penyakit);
    $arr_penyakit = [];
    while($r = $res_penyakit->fetch_assoc()){
        $arr_penyakit[] = $r['idpenyakit'];
    }
    $res_penyakit->free();

    foreach($arr_penyakit as $idpenyakit){
        // Hitung jumlah gejala di basis aturan untuk penyakit ini
        $sql_jml = "SELECT COUNT(dba.idgejala) AS jml_gejala
                    FROM basis_aturan ba
                    INNER JOIN detail_basis_aturan dba ON ba.idaturan = dba.idaturan
                    WHERE ba.idpenyakit='$idpenyakit'";
        $res_jml  = $conn->query($sql_jml);
        $row_jml  = $res_jml->fetch_assoc();
        $jml_gejala = intval($row_jml['jml_gejala']);
        $res_jml->free();

        if($jml_gejala == 0) continue;

        // Ambil semua gejala basis aturan untuk penyakit ini ke array PHP
        $sql_gejala_ba = "SELECT dba.idgejala
                          FROM basis_aturan ba
                          INNER JOIN detail_basis_aturan dba ON ba.idaturan = dba.idaturan
                          WHERE ba.idpenyakit='$idpenyakit'";
        $res_gejala_ba  = $conn->query($sql_gejala_ba);
        $arr_gejala_ba  = [];
        while($r = $res_gejala_ba->fetch_assoc()){
            $arr_gejala_ba[] = intval($r['idgejala']);
        }
        $res_gejala_ba->free();

        // Hitung kecocokan dengan cara membandingkan array PHP
        // (tidak perlu query ke DB per gejala, lebih cepat dan bebas konflik)
        $arr_gejala_pasien = array_map('intval', $arr_idgejala);
        $jyes = count(array_intersect($arr_gejala_ba, $arr_gejala_pasien));

        // Hitung persentase kecocokan
        $peluang = round(($jyes / $jml_gejala) * 100, 2);

        // Simpan jika ada kecocokan
        if($peluang > 0){
            $sql_ins = "INSERT INTO detail_penyakit (idkonsultasi, idpenyakit, persentase)
                        VALUES ('$idkonsultasi','$idpenyakit','$peluang')";
            mysqli_query($conn, $sql_ins);
        }
    }

    // Tutup koneksi setelah semua proses selesai
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
                                <label>Usia (tahun)</label>
                                <input type="text" class="form-control bg-light"
                                       value="<?php echo $usia_terhitung; ?> tahun" readonly>
                                <small class="form-text text-muted">Dihitung otomatis dari tanggal lahir</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" class="form-control bg-light"
                                       value="<?php echo $jenis_kelamin == 'L' ? 'Laki-laki' : ($jenis_kelamin == 'P' ? 'Perempuan' : '-'); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Golongan Darah</label>
                                <input type="text" class="form-control bg-light"
                                       value="<?php echo !empty($golongan_darah) ? $golongan_darah : '-'; ?>" readonly>
                            </div>
                        </div>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Alamat <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light" id="alamat" name="alamat"
                                           value="<?php echo htmlspecialchars($alamat_pasien); ?>"
                                           maxlength="200" readonly required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="btnEditAlamat" title="Edit alamat">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </div>
                                </div>
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

                    <!-- Kotak pencarian manual — tidak memakai DataTables agar semua checkbox tetap ada di DOM -->
                    <div class="input-group mb-2" style="max-width:400px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="cariGejala" class="form-control"
                               placeholder="Cari gejala..." autocomplete="off">
                    </div>

                    <table class="table table-bordered table-hover" id="tabelGejala">
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
                                $sql_gejala_list = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                $res_gejala_list = $conn->query($sql_gejala_list);
                                while($row_gejala = $res_gejala_list->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" class="check-item"
                                           name="idgejala[]"
                                           value="<?php echo $row_gejala['idgejala']; ?>">
                                </td>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row_gejala['nmgejala']); ?></td>
                            </tr>
                            <?php } $res_gejala_list->free(); ?>
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

    // Alamat: readonly secara default, bisa diedit lewat tombol pensil
    document.getElementById('btnEditAlamat').addEventListener('click', function(){
        var inputAlamat = document.getElementById('alamat');
        inputAlamat.readOnly = false;
        inputAlamat.classList.remove('bg-light');
        inputAlamat.focus();
    });

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

    // Pencarian manual — semua baris tetap ada di DOM, hanya disembunyikan via CSS
    document.getElementById('cariGejala').addEventListener('keyup', function(){
        var kata = this.value.toLowerCase();
        var baris = document.querySelectorAll('#tabelGejala tbody tr');
        baris.forEach(function(tr){
            var teks = tr.querySelector('td:last-child').textContent.toLowerCase();
            tr.style.display = teks.includes(kata) ? '' : 'none';
        });
    });

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
