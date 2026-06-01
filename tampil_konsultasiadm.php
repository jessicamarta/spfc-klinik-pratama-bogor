<div class="card border-0 shadow-sm">
  <div class="card-header bg-primary text-white border-dark">
    <strong><i class="fas fa-clipboard-list mr-2"></i>Data Hasil Konsultasi Pasien</strong>
  </div>
  <div class="card-body">
    <table class="table table-bordered" id="myTable">
    <thead class="thead-light">
      <tr>
        <th width="50px">No.</th>
        <th width="110px">Tanggal</th>
        <th>Nama Pasien</th>
        <th width="70px" class="text-center">Usia</th>
        <th width="80px" class="text-center">Goldar</th>
        <th width="80px" class="text-center">Aksi</th>
      </tr>
    </thead>
    <tbody>
     <?php
        $no  = 1;
        $sql = "SELECT * FROM konsultasi ORDER BY tanggal DESC, idkonsultasi DESC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td class="text-center"><?php echo isset($row['usia']) && $row['usia'] > 0 ? $row['usia'] . ' thn' : '-'; ?></td>
            <td class="text-center"><?php echo !empty($row['golongan_darah']) ? $row['golongan_darah'] : '-'; ?></td>
            <td class="text-center">
                <a class="btn btn-primary btn-sm"
                   href="?page=konsultasiadm&action=detail&id=<?php echo $row['idkonsultasi']; ?>">
                    <i class="fas fa-list"></i>
                </a>
            </td>
     </tr>
    <?php
     }
     $conn->close();
    ?>
   </tbody>
</table>
</div>
</div>
