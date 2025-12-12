<?php
//...\spkbayes\public\pages\dashboardadmin\data_probabilitas.php

$current_role = $_SESSION['user_role'] ?? 'unknown';
if ($current_role !== 'admin') {
  echo '<div class="alert alert-danger">Anda tidak memiliki izin untuk mengakses halaman ini.</div>';
  return;
}

// 2. Koneksi ke Database (Gunakan config/db_config.php)
require_once dirname(dirname(dirname(__DIR__))) . '/config/db_config.php';
$conn = connect_db();

// 3. Ambil Data Latih
$query = "SELECT x1_anggota, x2_absensi, x3_prestasi, x4_kepuasan, x5_pembina, class_label FROM historical_data";
$result = $conn->query($query);
$historical_data = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Konversi nilai ke string agar array_column bekerja, pastikan data bersih
    foreach ($row as $key => $val) {
      $row[$key] = trim(strtoupper((string)$val));
    }
    $historical_data[] = $row;
  }
}
$conn->close();

$N = count($historical_data);
$CLASSES = ['SE', 'E', 'PE'];
$FEATURES = ['x1_anggota', 'x2_absensi', 'x3_prestasi', 'x4_kepuasan', 'x5_pembina'];

$probabilitas = [
  'prior' => [],
  'likelihood' => []
];

// 4. Hitung Probabilitas Prior P(C)
$all_classes = array_column($historical_data, 'class_label');
$class_counts = array_count_values($all_classes);

foreach ($CLASSES as $C) {
  $count = $class_counts[$C] ?? 0;
  $prob = ($N > 0) ? ($count / $N) : 0;
  $probabilitas['prior'][$C] = $prob;
}

// 5. Hitung Probabilitas Kondisional P(E|C)
foreach ($FEATURES as $F) {
  foreach ($CLASSES as $C) {
    $NC = $class_counts[$C] ?? 0; // Jumlah data di kelas C

    $data_in_class = array_filter($historical_data, function ($row) use ($C) {
      return ($row['class_label'] === $C);
    });

    $feature_values_in_class = array_column($data_in_class, $F);
    $feature_counts_in_class = array_count_values($feature_values_in_class);

    foreach ($feature_counts_in_class as $value => $count_value) {
      // Perhitungan Dasar: Count / Nc
      $prob = ($NC > 0) ? ($count_value / $NC) : 0;

      // Pastikan struktur array ada
      if (!isset($probabilitas['likelihood'][$F])) $probabilitas['likelihood'][$F] = [];
      if (!isset($probabilitas['likelihood'][$F][$value])) $probabilitas['likelihood'][$F][$value] = [];

      $probabilitas['likelihood'][$F][$value][$C] = $prob;
    }
  }
}

if ($N === 0) {
  $warning_message = '<div class="alert alert-warning">Data Latih (historical_data) masih kosong. Probabilitas tidak dapat dihitung.</div>';
}
?>

<div class="row">
  <div class="col-12">
    <div class="card card-secondary card-outline">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-percent"></i> Data Probabilitas Model Naive Bayes</h3>
      </div>
      <div class="card-body">
        <?= $warning_message ?? '' ?>

        <p>Data berikut adalah Matriks Probabilitas yang dipelajari dari <b><?= $N ?> data latih</b> pada tabel `historical_data`. Ini adalah dasar perhitungan prediksi SPK.</p>

        <h4 class="mt-4">1. Probabilitas Prior P(C)</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-sm" style="width: auto;">
            <thead class="bg-light">
              <tr>
                <th>Kelas (C)</th>
                <th>Frekuensi (Count)</th>
                <th>P(C) = Count / N</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($CLASSES as $C): ?>
                <tr>
                  <td><?= htmlspecialchars($C) ?></td>
                  <td><?= $class_counts[$C] ?? 0 ?></td>
                  <td><?= number_format($probabilitas['prior'][$C] ?? 0, 4) ?></td>
                </tr>
              <?php endforeach; ?>
              <tr class="table-info">
                <td><b>Total Data (N)</b></td>
                <td><b><?= $N ?></b></td>
                <td><b><?= number_format(array_sum($probabilitas['prior']), 4) ?></b></td>
              </tr>
            </tbody>
          </table>
        </div>

        <h4 class="mt-4">2. Probabilitas Kondisional P(E|C)</h4>
        <p class="text-muted">Probabilitas kemunculan nilai kriteria (E) jika kelas (C) sudah diketahui. (Likelihood)</p>

        <?php foreach ($FEATURES as $F): ?>
          <h5 class="mt-3">Fitur: <b><?= strtoupper($F) ?></b></h5>
          <div class="table-responsive">
            <table class="table table-bordered table-sm" style="width: 100%;">
              <thead class="bg-primary">
                <tr>
                  <th>Nilai Kriteria (E)</th>
                  <?php foreach ($CLASSES as $C) echo "<th>P(E | $C)</th>"; ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $feature_likelihood = $probabilitas['likelihood'][$F] ?? [];
                $all_values = array_keys($feature_likelihood);

                foreach ($all_values as $V):
                ?>
                  <tr>
                    <td><?= htmlspecialchars($V) ?></td>
                    <?php foreach ($CLASSES as $C): ?>
                      <td>
                        <?= number_format($feature_likelihood[$V][$C] ?? 0, 4) ?>
                      </td>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>