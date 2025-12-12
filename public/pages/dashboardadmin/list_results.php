<?php
// ...\spkbayes\public\pages\dashboardadmin\list_results.php
// Catatan: Variabel $results sudah tersedia dari EvaluationController.php::index()

// Fungsi utility untuk Badge
function get_badge_class($class)
{
  switch (strtoupper($class)) {
    case 'SE':
      return 'badge-success';
    case 'E':
      return 'badge-warning';
    case 'PE':
      return 'badge-danger';
    default:
      return 'badge-secondary';
  }
}
?>

<div class="row">
  <div class="col-12">
    <div class="card card-info card-outline">
      <div class="card-header">
        <h3 class="card-title">Riwayat Hasil Prediksi</h3>
        <div class="card-tools">
          <a href="admin.php?page=form_input" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Input Evaluasi Baru
          </a>
        </div>
      </div>
      <div class="card-body table-responsive">
        <table id="resultsTable" class="table table-bordered table-hover table-sm">
          <thead class="bg-info">
            <tr>
              <th>#</th>
              <th>Ekskul</th>
              <th>Semester</th>
              <th>Kriteria Input</th>
              <th>Hasil Prediksi</th>
              <th>P(SE)</th>
              <th>P(E)</th>
              <th>P(PE)</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($results)): ?>
              <tr>
                <td colspan="9" class="text-center">Belum ada riwayat hasil evaluasi.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($results as $i => $res): ?>
                <?php $input = json_decode($res['input_criteria'], true); ?>

                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><b><?= htmlspecialchars($res['ekskul_name']) ?></b></td>
                  <td><?= htmlspecialchars($res['semester']) ?></td>
                  <td style="font-size: 0.85rem;">
                    X1 (Agt): <b><?= $input['x1_anggota'] ?></b><br>
                    X2 (Abs): <b><?= $input['x2_absensi'] ?></b><br>
                    X3 (Pre): <b><?= $input['x3_prestasi'] ?></b><br>
                    X4 (Kep): <b><?= $input['x4_kepuasan'] ?></b><br>
                    X5 (Pem): <b><?= $input['x5_pembina'] ?></b>
                  </td>
                  <td>
                    <span class="badge <?= get_badge_class($res['predicted_class']) ?>">
                      <?= htmlspecialchars($res['predicted_class']) ?>
                    </span>
                  </td>
                  <td class="text-right"><?= number_format($res['p_sangat_efektif'], 2) ?>%</td>
                  <td class="text-right"><?= number_format($res['p_efektif'], 2) ?>%</td>
                  <td class="text-right"><?= number_format($res['p_perlu_evaluasi'], 2) ?>%</td>
                  <td style="font-size: 0.8rem;"><?= date('d M Y H:i', strtotime($res['created_at'])) ?></td>
                </tr>

              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>