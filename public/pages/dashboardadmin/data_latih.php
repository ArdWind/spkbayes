<?php
//...\spkbayes\public\pages\dashboardadmin\data_latih.php

// --- Pastikan Variabel Peran Tersedia ---
// Variabel ini di set di admin.php setelah user_logged_in dicek.
$current_role = $_SESSION['user_role'] ?? 'unknown';

// 1. Cek Akses (Hanya Admin yang boleh melihat)
if ($current_role !== 'admin') {
  echo '<div class="alert alert-danger">Anda tidak memiliki izin untuk mengakses halaman ini.</div>';
  return; // Hentikan eksekusi script
}

// 2. Hubungkan ke Database
// Path: Dari public/pages/dashboardadmin/ naik tiga level ke root spkbayes/ lalu ke config/
require_once dirname(dirname(dirname(__DIR__))) . '/config/db_config.php';
$conn = connect_db();

// 3. Ambil Data
$query = "SELECT * FROM historical_data ORDER BY id DESC";
$result = $conn->query($query);
$data_latih = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data_latih[] = $row;
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Latih (Historical Data)</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Data Baru
          </button>
        </div>
      </div>
      <div class="card-body table-responsive">
        <table id="dataLatihTable" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Ekskul</th>
              <th>Semester</th>
              <th>X1 Anggota</th>
              <th>X2 Absensi</th>
              <th>X3 Prestasi</th>
              <th>X4 Kepuasan</th>
              <th>X5 Pembina</th>
              <th>Class Label</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($data_latih)): ?>
              <tr>
                <td colspan="10" class="text-center">Tidak ada data latih yang ditemukan.</td>
              </tr>
            <?php else: ?>
              <?php $no = 1;
              foreach ($data_latih as $data): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($data['ekskul_name']) ?></td>
                  <td><?= htmlspecialchars($data['ta_semester']) ?></td>
                  <td><?= htmlspecialchars($data['x1_anggota']) ?></td>
                  <td><?= htmlspecialchars($data['x2_absensi']) ?></td>
                  <td><?= htmlspecialchars($data['x3_prestasi']) ?></td>
                  <td><?= htmlspecialchars($data['x4_kepuasan']) ?></td>
                  <td><?= htmlspecialchars($data['x5_pembina']) ?></td>
                  <td><span class="badge bg-success"><?= htmlspecialchars($data['class_label']) ?></span></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
// 4. Tutup Koneksi Database
$conn->close();
?>