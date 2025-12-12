<?php
// ...\spkbayes\public\pages\dashboardadmin\form_input.php
// Catatan: Variabel $ekskulOptions sudah tersedia dari EvaluationController.php::create()

// Jika sukses, tampilkan notifikasi
$success_count = $_GET['success'] ?? 0;
if ($success_count > 0):
?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
    Prediksi berhasil dilakukan untuk <b><?= $success_count ?> Ekskul</b> dan hasil telah disimpan ke riwayat.
        <a href="admin.php?page=list_results" class="btn btn-sm btn-light ml-3">Lihat Hasil</a>
  </div>
<?php endif; ?>

<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Kriteria Input Evaluasi</h3>
  </div>
  <form method="POST" action="admin.php?page=form_input">
    <div class="card-body">

      <div class="form-group row">
        <label for="semester" class="col-sm-2 col-form-label">Periode/Semester</label>
        <div class="col-sm-4">
          <input type="text" name="semester" id="semester" class="form-control" value="<?= date('Y') . '-' . (date('m') > 6 ? '1' : '2') ?>" required>
        </div>
      </div>

      <hr>

      <div class="table-responsive">
        <table class="table table-bordered table-sm">
          <thead class="bg-primary">
            <tr>
              <th>Nama Ekskul</th>
              <th>X1 Anggota (%)</th>
              <th>X2 Absensi (%)</th>
              <th>X3 Prestasi</th>
              <th>X4 Kepuasan</th>
              <th>X5 Pembina</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ekskulOptions as $ek): ?>
              <tr>
                <td>
                  <b><?= $ek ?></b>
                      <input type="hidden" name="ekskul_data[<?= $ek ?>][name]" value="<?= $ek ?>">
                </td>

                <td><input type="number" name="ekskul_data[<?= $ek ?>][x1_anggota_count]" class="form-control form-control-sm" placeholder="Contoh: 25.5" required min="0" max="100"></td>
                <td><input type="number" step="0.1" name="ekskul_data[<?= $ek ?>][x2_absensi_percent]" class="form-control form-control-sm" placeholder="Contoh: 90" required min="0" max="100"></td>

                <td>
                  <select name="ekskul_data[<?= $ek ?>][x3_prestasi_status]" class="form-control form-control-sm">
                    <option value="TAP">Tidak Ada Piala</option>
                    <option value="AP">Ada Piala</option>
                  </select>
                </td>

                <td>
                  <select name="ekskul_data[<?= $ek ?>][x4_kepuasan_modus]" class="form-control form-control-sm">
                    <option value="SP">Sangat Puas</option>
                    <option value="P">Puas</option>
                    <option value="TP">Tidak Puas</option>
                  </select>
                </td>

                <td>
                  <select name="ekskul_data[<?= $ek ?>][x5_pembina_type]" class="form-control form-control-sm">
                    <option value="BS">Bersertifikat</option>
                    <option value="GS">Guru Sekolah</option>
                    <option value="A">Alumni</option>
                  </select>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-success"><i class="fas fa-calculator"></i> Proses Prediksi</button>
    </div>
  </form>
</div>